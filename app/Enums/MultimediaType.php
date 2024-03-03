<?php
namespace App\Enums;


enum MultimediaType: string {

    case ImageGif       = 'image/gif';
    case ImageIcon      = 'image/x-icon';
    case ImageJpeg      = 'image/jpeg';
    case ImageWebp      = 'image/webp';
    case ImagePng       = 'image/png';
    case ImageSvgXml    = 'image/svg+xml';
    case VideoMpeg      = 'video/mpeg';
    case VideoOgg       = 'video/ogg';

};
