<?php

namespace App\Models;

use App\Services\StorageService;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public const TYPE_DEFAULT = 'default';

    protected $appends = ['url'];

    protected $fillable = [
        'id',
        'name',
        'type',
        'author_id',
        'path',
        'size',
        'fileable_type',
        'fileable_id'
    ];

    public function fileable()
    {
        return $this->morphTo();
    }

    public function getUrlAttribute(): string
    {
        $storageService = resolve(StorageService::class);
        return asset($storageService->url($this));
    }
}
