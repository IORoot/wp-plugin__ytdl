<?php

class andyp_filter_downloader_ffmpeg
{

    public function __construct()
    {
        add_filter('ytdl_ffmpeg', array($this, 'ytdl_ffmpeg_filter'), 10, 3);
    }


    /**
     * ytdl_ffmpeg_filter
     * 
     * Download and store a youtube video.
     * 
     * Will return an array of information about the downloaded video.
     *
     * @param string $videocode
     * @return array
     */
    function ytdl_ffmpeg_filter($videocode, $starttime = null, $duration = null)
    {

        if ($videocode == null || $videocode == ''){ return; }

        $yt = new andyp_downloader_ffmpeg();
        $yt->set_videocode($videocode);
        $yt->set_starttime($starttime);
        $yt->set_duration($duration);
        $yt->andyp_ytdl_run();
        $result = $yt->get_results();

        return $result;
    }

}