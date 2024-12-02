<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class WhyChooseUs extends Model
{
    use HasFactory;

    protected $table = 'why_choose_us';

    protected $fillable = [
        'title',
        'description',
        'icon'
    ];

    public function aboutPages(): BelongsToMany
    {
        return $this->belongsToMany(AboutPage::class, 'about_page_why_choose_us')
            ->withTimestamps();
    }
}
