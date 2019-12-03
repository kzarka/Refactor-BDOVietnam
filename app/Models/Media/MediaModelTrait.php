<?php

namespace App\Models\Media;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;

trait MediaModelTrait
{
    public function getFirstMedia($collection = null)
    {
        return $this->queryMedias($collection)->first();
    }

    /**
     * get first media path
     * @param null $collection
     * @return mixed
     */
    public function getFirstMediaPath($collection = null)
    {
        return $this->queryMedias($collection)->pluck('file_path')->first();
    }

    /**
     * get media paths
     * @param null $collection
     * @return mixed
     */

    public function getMediaPaths($collection = null)
    {
        return $this->queryMedias($collection)->pluck('file_path');
    }

    /**
     * get media urls
     * @param null $collection
     * @return mixed
     */
    public function getMediaUrls($collection = null)
    {
        return $this->getMediaPaths($collection)->map(function ($filePath) {
            return $this->getUrlByPath($filePath);
        });
    }

    /**
     * get first media from list medias urls
     * @param null $collection
     * @return mixed|null
     */
    public function getFirstMediaUrl($collection = null)
    {
        if ($filePath = $this->getFirstMediaPath($collection)) {
            return $this->getUrlByPath($filePath);
        }
        return null;
    }

    /**
     ** get first media that fixed by some url
     * @param null $collection
     * @return mixed
     */
    public function getFirstFixedMediaUrl($collection = null)
    {
        return $this->queryMedias($collection)->pluck('fixed_url')->first();
    }

    /**
     * get media that fixed by some url
     * @param null $collection
     * @return mixed
     */
    public function getFixedMediaUrls($collection = null)
    {
        return $this->queryMedias($collection)->pluck('fixed_url');
    }

    /**
     * add media from path
     * @param $path
     * @param null $collection
     * @param null $filename
     */
    public function addMediaFromPath($path, $collection = null, $filename = null)
    {
        $fileToSave = \Image::make($path);
        $this->addMediaFromImage($fileToSave, $collection, $filename);
    }

    /**
     * add media file from url
     * @param $url
     * @param null $collection
     * @param null $filename
     */
    public function addMediaFromUrl($url, $collection = null, $filename = null)
    {
        $fileToSave = \Image::make($url);
        $this->addMediaFromImage($fileToSave, $collection, $filename);
    }

    /**
     * add media file from upload file
     * @param null $fileUpload
     * @param null $collection
     * @param null $filename
     */
    public function addMediaFromFileUpload($fileUpload, $collection = null, $filename = null)
    {
        $fileToSave = \Image::make($fileUpload);
        $this->addMediaFromImage($fileToSave, $collection, $filename);
    }

    /**
     * add media from base64
     * @param $base64
     * @param null $collection
     * @param null $filename
     */
    public function addMediaFromBase64($base64, $collection = null, $filename = null)
    {
        $fileToSave = \Image::make($base64);
        $this->addMediaFromImage($fileToSave, $collection, $filename);
    }

    /**
     * add media file from file object (File)
     * @param Image $fileToSave
     * @param null $collection
     * @param null $filename
     */
    public function addMediaFromImage(Image $fileToSave, $collection = null, $filename = null)
    {
        try {
            $this->addMediaCollectionFromImage($fileToSave, $collection, $filename);
            if (isset(self::$mediaConfigs['conversions'][$collection])) {
                $conversions = self::$mediaConfigs['conversions'][$collection];
                if (is_array($conversions)) {
                    foreach ($conversions as $additionCollection => $conversion) {
                        $width = isset($conversion['width']) ? $conversion['width'] : null;
                        $height = isset($conversion['height']) ? $conversion['height'] : null;
                        if ($width && $height) {
                            $newFileToSave = (clone $fileToSave);
                            $newFileToSave->resize($width, $height);
                        } else {
                            $newFileToSave = (clone $fileToSave);
                            $newFileToSave->resize($width, $height, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        }
                        $this->addMediaCollectionFromImage($newFileToSave, $additionCollection, $filename);
                    }
                }
            }
            \DB::commit();
        } catch (\Exception $e) {
            echo $e->getMessage();
            \DB::rollback();
        }
    }

    public function addMediaCollectionFromImage(Image $fileToSave, $collection = null, $filename = null)
    {
        $mediaTable = self::$mediaConfigs['table'];
        $foreignKey = self::$mediaConfigs['foreign_key'];
        $pathPrefix = self::$mediaConfigs['path_prefix'];
        $uniqPath = uniqid();
        if (is_null($filename)) {
            $filenameHash = hash('tiger192,3', uniqid());
            $filenameExt = $fileToSave->mime() ? explode('/', $fileToSave->mime())[1] : null;
            $filename = $filenameHash . (empty($filenameExt) ? null : '.' . $filenameExt);
        }
        $pathToStore = "$pathPrefix/$collection/$uniqPath";
        try {
            \DB::beginTransaction();
            \DB::table($mediaTable)->insert([
                $foreignKey => $this->id,
                'uniq_path' => $uniqPath,
                'collection' => $collection,
                'name' => $filename,
                'created_at' => Carbon::now()
            ]);
            Storage::disk(STORAGE_MEDIA_DISK)->put($pathToStore . '/' . $filename, $fileToSave->encode()->__toString());
            \DB::commit();
        } catch (\Exception $e) {
            echo $e->getMessage();
            \DB::rollback();
        }
    }

    /**
     * add media url into model
     * @param $url
     * @param null $collection
     * @return
     */
    public function addFixedMediaUrl($url, $collection = null)
    {
        return \DB::table(self::$mediaConfigs['table'])->insert([
            self::$mediaConfigs['foreign_key'] => $this->id,
            'collection' => $collection,
            'fixed_url' => $url,
            'uniq_path' => uniqid(),
            'created_at' => Carbon::now()
        ]);
    }

    public function removeMedias($collection = null)
    {
        $rm = \DB::table(self::$mediaConfigs['table'])->where([
            self::$mediaConfigs['foreign_key'] => $this->id,
        ]);
        if ($collection) {
            $rm = $rm->where(['collection' => $collection]);
        }

        /**  Delete file in local */
        foreach ($rm->get(['uniq_path']) as $uniq_path) {
            try {
                $this->deleteDirectory($uniq_path->uniq_path);
            } catch (\Exception $e) {

            }
        }

        $rm->delete();
    }

    /**
     * remove media by unique path
     * @param $uniq_path
     * @return mixed
     */
    public function removeMediaByUniqPath($uniq_path)
    {
        // Delete directory in storage local
        $this->deleteDirectory($uniq_path);

        return \DB::table(self::$mediaConfigs['table'])->where([
            self::$mediaConfigs['foreign_key'] => $this->id,
            'uniq_path' => $uniq_path
        ])->delete();
    }

    /**
     * get url image by file path
     * @param $filePath
     * @return mixed
     */
    public function getUrlByPath($filePath)
    {
        return \Storage::disk(STORAGE_MEDIA_DISK)->url(self::$mediaConfigs['path_prefix'] . '/' . $filePath);
    }

    /**
     * raw query medias
     * @param null $collection
     * @return mixed
     */
    public function queryMedias($collection = null)
    {
        $mediaTable = self::$mediaConfigs['table'];
        $ownerKey = self::$mediaConfigs['owner_key'];
        $foreignKey = self::$mediaConfigs['foreign_key'];
        $builder = $this->select(\DB::raw("CONCAT(if($mediaTable.collection is null,'',$mediaTable.collection), '/', $mediaTable.uniq_path, '/', $mediaTable.name) AS file_path"), 'fixed_url', 'collection')->join(
            $mediaTable,
            $this->table . '.' . $ownerKey,
            '=',
            $mediaTable . '.' . $foreignKey
        )->where($foreignKey, $this->id);
        if ($collection) {
            $builder = $builder->where("$mediaTable.collection", $collection);
        }
        return $builder;
    }


    /**
     * Delete file in storage local
     * @param $filePath
     * @return mixed
     */
    public function deleteFile($filePath)
    {
        return \Storage::disk(STORAGE_MEDIA_DISK)->delete(self::$mediaConfigs['path_prefix'] . '/' . $filePath);
    }

    /**
     * Delete directory in storage local
     * @param $uniq_path
     * @return mixed
     */
    public function deleteDirectory($uniq_path)
    {
        return \Storage::disk(STORAGE_MEDIA_DISK)->deleteDirectory(self::$mediaConfigs['path_prefix'] . '/' . $uniq_path);
    }
}
