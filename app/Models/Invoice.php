<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'project_id',
        'client_id',
        'invoice_number',
        'issue_date',
        'amount',
        'due_date',
        'status',
    ];
}
