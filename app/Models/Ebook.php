<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'author',
        'description',
        'main_image',
        'image_path',
        'ebook_pages',
        'format',
        'language',

    ];

    public function category()
    {
        return $this->belongsTo(EbookCategory::class);
    }


    public function ebookGalleries()
    {
        return $this->hasMany(EbookGallery::class);
    }
}
