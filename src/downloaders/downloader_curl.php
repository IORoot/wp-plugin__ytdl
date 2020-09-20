<?php


class andyp_downloader_curl
{

    private $links;

    private $video_code;

    public function set_videocode($video_code)
    {
        $this->video_code = $video_code;
    }
    

    public function get_results()
    {
        return $this->target;
    }


    public function andyp_ytdl_run()
    {
        $this->get_video_url();
        if (empty($this->links)){ return; }
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
        foreach ($this->links as $key => $link)
        {
            $format_array = explode(', ', $link['format']);
            if (in_array('video', $format_array) && in_array('audio', $format_array))
            {
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
        $this->target['filename'] = $this->target['path'] . '/' . $this->video_code . '.' .$this->target['ext'];
        $this->target['filepath'] = fopen($this->target['filename'], "w");
    }


    private function download()
    {
        // create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, $this->target['url']);

        // send to file
        curl_setopt($ch, CURLOPT_FILE, $this->target['filepath']);

        // set header
        curl_setopt($ch, CURLOPT_HEADER, 0);

        // Run
        $this->target['curl_exec'] = curl_exec($ch);

        $this->target['curl_info'] = curl_getinfo($ch);

        if(curl_error($ch)) {
            fwrite($this->target['filepath'], curl_error($ch));
            $this->target['downloaded'] = false;
        }

        // close channel
        curl_close($ch);

        // close file.
        fclose($this->target['filepath']);
    
        $this->target['downloaded'] = true;
        return;
    }

}