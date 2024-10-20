<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name',
        'description',
        'project_id',
        'user_id',
        'status',
        'priority',
        'due_date',
    ];
}
