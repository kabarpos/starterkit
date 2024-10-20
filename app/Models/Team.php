<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'description',
        'leader_id',

    ];

    public function teamMembers()
    {
        return $this->hasMany(TeamMember::class, 'team_id');
    }
}
