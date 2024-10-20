<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    protected $casts = [
        'price' => 'unsignedBigint',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_services')
            ->withPivot('price')
            ->withTimestamps();
    }
}
