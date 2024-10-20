<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectService extends Model
{
    protected $fillable = ['project_id', 'service_id', 'price'];

    protected $casts = [
        'price' => 'unsigedBigint',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
