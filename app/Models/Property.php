<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Property extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'type',
        'bedrooms',
        'bathrooms',
        'land_size',
        'address',
        'city',
        'state',
        'zip_code',
        'status',
        'features',
        'is_featured'
    ];

    protected $casts = [
        'features' => 'array',
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('property-images')
            ->useDisk('public');

        $this->addMediaCollection('thumbnail')
            ->singleFile()
            ->useDisk('public');
    }
}
