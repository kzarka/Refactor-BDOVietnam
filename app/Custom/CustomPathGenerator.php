<?php
namespace App\Custom;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\PathGenerator\PathGenerator;
class CustomPathGenerator implements PathGenerator
{
    public function getPath(Media $media) : string
    {
        return $media->collection_name .'/';
    }
    public function getPathForConversions(Media $media) : string
    {
        return $this->getPath($media).'conversions/';
    }
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media).'responsive/';
    }
}