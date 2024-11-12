<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EbookCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image',
    ];

    public function ebooks()
    {
        return $this->hasMany(Ebook::class);
    }
}
