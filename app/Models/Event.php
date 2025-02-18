<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'ticket_count',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
