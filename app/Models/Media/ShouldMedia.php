<?php

namespace App\Models\Media;

use Intervention\Image\Image;

interface ShouldMedia
{
    public function getFirstMedia($collection = null);

    public function getFirstMediaPath($collection = null);

    public function getMediaPaths($collection = null);

    public function getMediaUrls($collection = null);

    public function getFirstMediaUrl($collection = null);

    public function getFixedMediaUrls($collection = null);

    public function getFirstFixedMediaUrl($collection = null);

    public function addMediaFromPath($path, $collection = null, $filename = null);

    public function addMediaFromUrl($url, $collection = null, $filename = null);

    public function addMediaFromFileUpload($fileUpload, $collection = null, $filename = null);

    public function addMediaFromBase64($base64, $collection = null, $filename = null);

    public function addMediaFromImage(Image $fileToSave, $collection = null, $filename = null);

    public function removeMedias($collection = null);

    public function removeMediaByUniqPath($uniq_path);

    public function getUrlByPath($filePath);

    public function deleteFile($filePath);

    public function deleteDirectory($uniq_path, $collection, $conversion);
}
