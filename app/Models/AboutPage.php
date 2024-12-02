<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AboutPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'content_title',
        'image'
    ];

    public function whyChooseUs(): BelongsToMany
    {
        return $this->belongsToMany(WhyChooseUs::class, 'about_page_why_choose_us')
            ->withTimestamps();
    }
}
