<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'category', 'slug', 'original_filename', 'filename_hash'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
