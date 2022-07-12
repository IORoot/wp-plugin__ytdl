
<div id="top"></div>

<div align="center">

<img src="https://svg-rewriter.sachinraja.workers.dev/?url=https%3A%2F%2Fcdn.jsdelivr.net%2Fnpm%2F%40mdi%2Fsvg%406.7.96%2Fsvg%2Fyoutube-tv.svg&fill=%237F1D1D&width=200px&height=200px" style="width:200px;"/>

<h3 align="center">Youtube Downloader</h3>

<p align="center">
Quick and dirty youtube video downloader using two different methods.
</p>
</div>


##  1. <a name='TableofContents'></a>Table of Contents


* 1. [Table of Contents](#TableofContents)
* 2. [About The Project](#AboutTheProject)
	* 2.1. [Built With](#BuiltWith)
	* 2.2. [Installation](#Installation)
* 3. [Usage](#Usage)
	* 3.1. [Description](#Description)
	* 3.2. [Shortcode](#Shortcode)
		* 3.2.1. [`[ytdl_curl]`](#ytdl_curl)
	* 3.3. [Filters](#Filters)
		* 3.3.1. [ytdl_curl](#ytdl_curl-1)
		* 3.3.2. [ytdl_ffmpeg](#ytdl_ffmpeg)
	* 3.4. [NOTE](#NOTE)
* 4. [Contributing](#Contributing)
* 5. [License](#License)
* 6. [Contact](#Contact)
* 7. [Changelog](#Changelog)


##  2. <a name='AboutTheProject'></a>About The Project

Allows you to download and manipulate YouTube videos with the `ytdl` project.

<p align="right">(<a href="#top">back to top</a>)</p>


###  2.1. <a name='BuiltWith'></a>Built With

This project was built with the following frameworks, technologies and software.

* [PHP](https://php.net/)
* [Wordpress](https://wordpress.org/)
* [Composer](https://getcomposer.org/)
* [Tailwind](https://tailwindcss.com/)
* curl
* [FFMpeg](https://ffmpeg.org/)
* [https://github.com/Athlon1600/youtube-downloader](https://github.com/Athlon1600/youtube-downloader)


<p align="right">(<a href="#top">back to top</a>)</p>



###  2.2. <a name='Installation'></a>Installation

These are the steps to get up and running with this plugin.

1. Clone the repo into your wordpress plugin folder
    ```sh
    git clone https://github.com/IORoot/wp-plugin__thumbnail-folders ./wp-content/plugins/thumbnail-folders
    ```
1. Composer.
    ```sh
    cd ./wp-content/plugins/thumbnail-folders
    composer install
    ```
1. install FFMpeg on your system if not already installed. Use on Ubuntu:
    ```
    sudo apt update
    sudo apt install ffmpeg
    ffmpeg -version
    ```

<p align="right">(<a href="#top">back to top</a>)</p>


##  3. <a name='Usage'></a>Usage


###  3.1. <a name='Description'></a>Description

First, it does a quick youtube URL grab using the https://github.com/Athlon1600/youtube-downloader package. This returns the URLs for download.

You can then use one of two methods to actually download the videos.

1.  CURL. This will just download the entire video into the current wordpress uploads directory.
2.  FFMpeg. You can supply a start point and a duration to download a partial part of the video into the uploads directory.


###  3.2. <a name='Shortcode'></a>Shortcode

####  3.2.1. <a name='ytdl_curl'></a>`[ytdl_curl]`

The shortcode can take a `v=` parameter with the Video ID code from YouTube. So, the video https://www.youtube.com/watch?v=dQw4w9WgXcQ

will have a shortcode parameter value of `dQw4w9WgXcQ`

So to download that video, you can use:

```php
[ytdl_curl v="dQw4w9WgXcQ"]
```

The shortcode will also output a `var_dump()` of ALL the links to that video.

You'll find the full downloaded video in the uploads directory.


Alternatively, you can supply the shortcode with no parameters, but add the videoID on the page URL as a parameter that will pick it up as a `$_GET['v']` value.

```http
http://domain.com/mypage.php?v=dQw4w9WgXcQ
```

with:

```php
[ytdl_curl]
```

Will give the same result.


###  3.3. <a name='Filters'></a>Filters

####  3.3.1. <a name='ytdl_curl-1'></a>ytdl_curl

You can use the filter to run the `curl` version of the downloader.

```php
$args = ['dQw4w9WgXcQ'];
$result = apply_filters_ref_array('ytdl_curl', $args);
```


####  3.3.2. <a name='ytdl_ffmpeg'></a>ytdl_ffmpeg

This filter will use FFMpeg to download a partial part of the video.

```php
$args = [
  'dQw4w9WgXcQ', 	// videoID
  '00:00:00', 		// start point in the video
  '00:00:30'			// duration from start point
];
$result = apply_filters_ref_array('ytdl_ffmpeg', $args);
```

###  3.4. <a name='NOTE'></a>NOTE

The FFMpeg process will run in a PHP `shell_exec()` command, so be careful with security and access to this, since it can run any command. All someone has to do is supply a semicolon and their own command to do anything.




<p align="right">(<a href="#top">back to top</a>)</p>



##  4. <a name='Contributing'></a>Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue.
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<p align="right">(<a href="#top">back to top</a>)</p>



##  5. <a name='License'></a>License

Distributed under the MIT License.

MIT License

Copyright (c) 2022 Andy Pearson

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

<p align="right">(<a href="#top">back to top</a>)</p>



##  6. <a name='Contact'></a>Contact

Project Link: [https://github.com/IORoot/...](https://github.com/IORoot/...)

<p align="right">(<a href="#top">back to top</a>)</p>



##  7. <a name='Changelog'></a>Changelog

v1.0.0 - First version.
