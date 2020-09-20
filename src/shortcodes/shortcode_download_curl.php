<?php

class andyp_shortcode_downloader_curl
{


    public function __construct()
    {
        add_shortcode( 'ytdl_curl', array($this,'ytdl_curl_run') );
    }



    public function ytdl_curl_run($atts)
    {
    
        $videocode = shortcode_atts(
            array(
                'v' => 'cltnytsc6vg',
            ),
            $atts
        );



        if (isset($_GET['v']))
        {
            $videocode['v'] = $_GET['v'];
        }



        if ($videocode['v'] == null || $videocode['v'] == ''){ return; }

        $yt = new andyp_downloader_curl();
        $yt->set_videocode($videocode['v']);
        $yt->andyp_ytdl_run();
        $result = $yt->get_results();

        var_dump($result);

    }




}