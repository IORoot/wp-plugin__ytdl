<?php


class andyp_downloader_ffmpeg
{
    private $links;

    private $video_code;
    private $starttime = '00:00:00';
    private $duration = '00:00:10';
    private $suffix = '';


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
    

    public function get_results()
    {
        return $this->target;
    }


    public function andyp_ytdl_run()
    {
        $this->get_video_url();
        if (empty($this->links)) {
            return;
        }
        $this->set_target();
        $this->set_download_path();
        $this->set_filename();
        $this->download();
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


    private function download()
    {
        $this->is_ffmpeg_installed();
        if (empty($this->ffmpeg)) {
            $this->target['ffmpeg_installed'] = false;
            return;
        }
        $this->target['ffmpeg_installed'] = true;

        $this->build_command();

        shell_exec($this->command);
        
    }


    private function is_ffmpeg_installed()
    {
        $this->ffmpeg = trim(shell_exec('which ffmpeg'));
    }


    private function build_command()
    {
        // ffmpeg installation dir
        $this->command = $this->ffmpeg;

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
}
