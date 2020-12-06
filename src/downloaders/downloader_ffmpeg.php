<?php


class andyp_downloader_ffmpeg
{
    private $links;

    private $video_code;
    private $starttime = '00:00:00';
    private $duration = '00:00:10';
    private $suffix = '';
    private $override = false;

    private $target;

    private $exists = false;


    public function set_videocode($video_code)
    {
        $this->video_code = $video_code;
    }

    public function set_starttime($starttime)
    {
        $this->starttime = $starttime;
    }

    public function set_duration($duration)
    {
        $this->duration = $duration;
    }

    public function set_suffix($suffix)
    {
        $this->suffix = $suffix;
    }
    

    public function set_override($override)
    {
        $this->override = $override;
    }
    

    public function get_results()
    {
        return $this->target;
    }


    public function andyp_ytdl_run()
    {

        if (!is_string($this->video_code)){ $this->target = "Video code is not a string, cannot process. Pass a string."; return; }

        $this->get_video_url();
        if (empty($this->links)) { $this->target = "No links found. Video could be wrong or maybe composer update?"; return; }

        $this->set_target();
        $this->set_download_path();
        $this->set_filename();
        if (empty($this->target)) { $this->target = "No Appropriate video link with audio found."; return; }

        $this->check_download();
        if ($this->exists && $this->override == false) {  $this->target = "File already exists. Did not download. Use override => true if needed."; return; }


        $this->is_ffmpeg_installed();
        if (empty($this->ffmpeg)) { $this->target = "FFMpeg is not installed on the system. Cannot download."; return; }

        $this->build_command();

        $this->download();

        $this->check_download();
        if (!$this->exists) { $this->target = "File does not exist. Did not download."; return; }

    }


    //  ┌─────────────────────────────────────────────────────────────────────────┐
    //  │                                                                         │░
    //  │                                                                         │░
    //  │                                 PRIVATE                                 │░
    //  │                                                                         │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░




    private function get_video_url()
    {

        $yt = new \YouTube\YouTubeDownloader();
    
        $this->links = $yt->getDownloadLinks('https://www.youtube.com/watch?v='.$this->video_code);

        
    }


    /**
     * Loop until best quality version found.
     */
    private function set_target()
    {
        foreach ($this->links as $key => $link) {
            $format_array = explode(', ', $link['format']);
            if (in_array('video', $format_array) && in_array('audio', $format_array)) {
                $this->target = $link;
                $this->target['ext'] = $format_array[0];
                $this->target['res'] = $format_array[2];
            }
        }
    }



    private function set_download_path()
    {
        $dir = wp_get_upload_dir();
        $this->target['path'] = $dir['path'];
    }


    private function set_filename()
    {
        $this->target['filename'] = $this->target['path'] . '/' . $this->video_code . $this->suffix . '.' .$this->target['ext'];
    }


    private function is_ffmpeg_installed()
    {
        $this->ffmpeg  = trim(shell_exec('which ffmpeg'));

        if (!empty($this->ffmpeg)) {
            $this->target['ffmpeg_installed'] = true;
        }
    }


    private function build_command()
    {
        // ffmpeg installation dir
        $this->command = $this->ffmpeg;

        // Log Levels to QUIET
        $this->command .= ' -hide_banner -loglevel panic ';

        // Auto confirmation of overwrite files.
        $this->command .= ' -y ';

        // start at
        $this->command .= ' -ss ';
        $this->command .= $this->starttime;

        // duration
        $this->command .= ' -t ';
        $this->command .= $this->duration;

        // input file
        $this->command .= ' -i ';
        $this->command .= '"' .$this->target['url'] . '"';

        // copy video
        $this->command .= ' -c:v copy ';

        // copy audio
        $this->command .= ' -c:a copy ';

        // target file
        $this->command .= $this->target['filename'];
    }


    private function download()
    {
        shell_exec($this->command);
    }


    private function check_download()
    {
        $this->exists = file_exists($this->target['filename']);
    }


}
