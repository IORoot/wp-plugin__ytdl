<?php

/*
 * @wordpress-plugin
 * Plugin Name:       _ANDYP - Youtube Downloader
 * Plugin URI:        http://londonparkour.com
 * Description:       <strong>🔌PLUGIN</strong> | <em>ANDYP > YT Downloader</em> | Download Youtube Videos
 * Version:           1.0.0
 * Author:            Andy Pearson
 * Author URI:        https://londonparkour.com
 * Domain Path:       /languages
 */

define( 'ANDYP_YTDL_URL', plugins_url( '/', __FILE__ ) );
define( 'ANDYP_YTDL_PATH', __DIR__ );

// ┌─────────────────────────────────────────────────────────────────────────┐
// │                         Use composer autoloader                         │
// └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/vendor/autoload.php';

/**
 * shortcode [youtube_dl]
 */
new andyp_shortcode_downloader_curl;

/**
 * filter name = get_yt_video
 */
new andyp_filter_downloader_curl;  
new andyp_filter_downloader_ffmpeg;  