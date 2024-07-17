<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    
    public const SUPER_ADMIN = 'superAdmin';
    public const USER        = 'user';

    protected $fillable = ['name'];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
