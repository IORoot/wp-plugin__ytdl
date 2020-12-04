<?php

/*
 * @wordpress-plugin
 * Plugin Name:       _ANDYP - Pipeline - Youtube Downloader
 * Plugin URI:        http://londonparkour.com
 * Description:       <strong>🤖 Pipeline</strong> | <em> YT Downloader | Download Youtube Videos
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
 * filter name = get_yt_video
 */
new andyp_filter_downloader_ffmpeg;  