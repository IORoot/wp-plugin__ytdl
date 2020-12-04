<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1001954beb50829a280560ae0d62d4f7
{
    public static $prefixLengthsPsr4 = array (
        'Y' => 
        array (
            'YouTube\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'YouTube\\' => 
        array (
            0 => __DIR__ . '/..' . '/athlon1600/youtube-downloader/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'andyp_downloader_ffmpeg' => __DIR__ . '/../..' . '/src/downloaders/downloader_ffmpeg.php',
        'andyp_filter_downloader_ffmpeg' => __DIR__ . '/../..' . '/src/filters/filter_download_ffmpeg.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1001954beb50829a280560ae0d62d4f7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1001954beb50829a280560ae0d62d4f7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1001954beb50829a280560ae0d62d4f7::$classMap;

        }, null, ClassLoader::class);
    }
}