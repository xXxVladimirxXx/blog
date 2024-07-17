<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $with = ['user'];

    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}