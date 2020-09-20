<?php

class andyp_filter_downloader_curl
{

    public function __construct()
    {
        add_filter('ytdl_curl', array($this, 'ytdl_curl_filter'), 10, 1);
    }


    /**
     * get_yt_video_filter
     * 
     * Download and store a youtube video.
     * 
     * Will return an array of information about the downloaded video.
     *
     * @param string $videocode
     * @return array
     */
    function ytdl_curl_filter($videocode)
    {

        if ($videocode == null || $videocode == ''){ return; }

        $yt = new andyp_downloader_curl();
        $yt->set_videocode($videocode);
        $yt->andyp_ytdl_run();
        $result = $yt->get_results();

        return $result;
    }

}