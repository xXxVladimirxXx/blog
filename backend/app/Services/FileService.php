<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Database\Eloquent\{Model, Builder};
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Exception;
use function config;

class FileService
{
    /**
     * @var File
     */
    protected $file;

    /**
     * @var StorageService
     */
    protected $storageService;

    /**
     * @var string(s3|local)
     */
    protected $disk;

    /**
     * FileService constructor.
     * @param File $file
     * @param StorageService $storageService
     */
    public function __construct(File $file, StorageService $storageService)
    {
        $this->file = $file;
        $this->storageService = $storageService;
        $this->disk = config('filesystems.default');
    }

    /**
     * @param $fileId
     * @return Builder|Model|object
     * @throws Exception
     */
    public function show($fileId) {
        $file = File::query();
        $file->where([['id', $fileId], ['is_public', 1]])->first();
        if(empty($file)) {
            throw new Exception('This File doesn\'t exists!', 404);
        }
        return $file;
    }

    /**
     *
     */
    public function getContent() {
        return file_get_contents(storage_path('app'). '/' . $this->file->path);
    }

    /**
     * @param Model $model
     * @param UploadedFile $file
     * @param string|null $type
     * @param bool $delete
     * @param array $options
     * @return bool|Exception|File
     * @throws Exception
     */
    public function save(Model $model, UploadedFile $file, string $type = null, $delete = false, array $options = [])
    {
        if (!$file->isFile()) {
            return false;
        }
        if(!$type) {
            $type = File::TYPE_DEFAULT;
        }

        try {
            $storagePath = 'public/' . Str::snake(class_basename($model)) . '/' . $type . '/' . $model->id . '/';

            if (!method_exists($model, 'files')) {
                throw new Exception('There is no files method in the model ' . get_class($model));
            }

            $filePath = $this->storageService->generatePath($storagePath, $file->getClientOriginalExtension());
            $tempFile = file_get_contents($file->getRealPath());

            if (!$this->storageService->put($filePath, $tempFile, 'public')) {
                throw new Exception('You can\' save the file!');
            }

            // if delete is true - then we remove prev files
            if ($delete) {
                foreach ($model->files()->where('type', $type)->get() as $item) {
                    $this->delete($item);
                }
            }

            $dataFile = [];

            return $model->files()->create($dataFile + [
                    'disk'      => $this->disk,
                    'name'      => $options['label'] ?? $file->getClientOriginalName(),
                    'path'      => $filePath,
                    'size'      => $this->storageService->size($filePath),
                    'type'      => $type,
                    'author_id' => $options['author_id'] ?? 1,
                ] + $options);
        } catch (Exception $exception) {
            throw $exception;
        }

    }

    /**
     * @param File $file
     * @return bool|null
     * @throws Exception
     */
    public function delete(File $file)
    {
        $this->storageService->delete($file);
        return $file->delete();
    }
}
