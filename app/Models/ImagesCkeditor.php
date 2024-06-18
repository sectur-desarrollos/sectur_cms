<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesCkeditor extends Model
{
    use HasFactory;

    protected $table = 'images_ckeditor';

    protected $fillable = [
        'image_url',
        'post_id',
    ];
}
