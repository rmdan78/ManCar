<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class StorageHelper {
    /**
     * Put file to storage
     *
     * @param string $path
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $disk
     * @return string|null
     */
    public static function put(string $path, UploadedFile $file, string $disk='local')
    {
        try {
            $ext = $file->getClientOriginalExtension();
            $filename = Str::uuid() . ".$ext";
            $pathname = "$path/$filename";

            Storage::disk($disk)->put($pathname, $file->getContent());

            return $pathname;
        } catch(Exception $err) {
            return null;
        }
    }


    /**
     * Put file to public storage
     *
     * @param string $path
     * @return string|null
     */
    public static function putPublic(string $path, UploadedFile $file)
    {
        return static::put($path, $file, 'public');
    }


    /**
     * Delete file from storage
     *
     * @param string $path
     * @param string $disk
     * @return bool
     */
    public static function delete(string $path, string $disk='local')
    {
        return Storage::disk($disk)->delete($path);
    }


    /**
     * Delete file from public storage
     *
     * @param string $path
     * @return bool
     */
    public static function deletePublic(string $path)
    {
        return static::delete($path, 'public');
    }


    /**
     * Get file from storage
     *
     * @param string $path
     * @param string $disk
     * @return string|null
     */
    public static function get(string $path, string $disk='local')
    {
        return Storage::disk($disk)->get($path);
    }


    /**
     * Get file from storage
     *
     * @param string $path
     * @return string|null
     */
    public static function getPublic(string $path)
    {
        return static::get($path, 'public');
    }


    /**
     * Get path url of the file from storage
     *
     * @param string|null $path
     * @return string
     */
    public static function path(string | null $path = '')
    {
        return Storage::url($path);
    }


    /**
     * Get full web url of the file from storage
     *
     * @param string|null $path
     * @return string
     */
    public static function url(string | null $path = '')
    {
        return url(static::path($path));
    }
}
