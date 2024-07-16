<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StorageService {

    /**
     * @var string
     */
    protected $disk;

    /**
     * StorageService constructor.
     * @param string $disk
     */
    public function __construct($disk = null)
    {
        $this->disk = $disk;
    }

    /**
     * @param File $file
     * @return bool|string
     */
    public function url(File $file) {
        return Storage::disk($file->disk)->url($file->path);
    }

    /**
     * @param File $file
     * @return string
     */
    public function path(File $file): string
    {
        return Storage::disk($file->disk)->path($file->path);
    }

    /**
     * @param $path
     * @param $contents
     * @param $options
     * @return mixed
     */
    public function put($path, $contents, $options = []) {
        return Storage::drive($this->disk)->put($path, $contents, $options);
    }

    /**
     * @param File $file
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function get(File $file) {
        return Storage::disk($file->disk)->get($file->path);
    }

    /**
     * @param $path
     * @return mixed
     */
    public function size($path) {
        return Storage::disk($this->disk)->size($path);
    }

    /**
     * @param File $file
     * @return bool
     */
    public function exists(File $file) {
        return Storage::disk($file->disk)->exists($file->path);
    }

    /**
     * @param File $file
     * @return bool
     */
    public function delete(File $file) {
        return Storage::disk($file->disk)->delete($file->path);
    }
    
    /**
     * @param File $file
     * @return false|string
     */
    public function mimeType(File $file) {
        return Storage::disk($file->disk)->mimeType($file->path);
    }

    /**
     * @param $type
     * @param $extension
     * @return string
     */
    public function getRandomFileName($type, $extension) {
        return md5($type . time()) . Str::random() . '.' . strtolower($extension);
    }

    /**
     * @param $directory
     * @param $extension
     * @return string
     */
    public function generatePath($directory, $extension) {
        return $directory . $this->getRandomFileName($directory, $extension);
    }
}
