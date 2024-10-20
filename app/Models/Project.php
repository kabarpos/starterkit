<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'client_id',
        'team_id',
        'status',
        'start_date',
        'due_date',
        'budget',
    ];

    protected $casts = [
        'start_date' => 'date',
        'due_date' => 'date',
        'budget' => 'unsignedBigInteger',

    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'project_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }

    public function teams()
    {
        return $this->hasMany(Team::class, 'team_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'project_services')
            ->withPivot('price')
            ->withTimestamps();
    }
}
