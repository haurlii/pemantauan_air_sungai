<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Normal extends Model
{
    use HasFactory;

    public $table = "water";

    protected $fillable = [
        'days',
        'date',
        'time',
        'level',
        'action',
    ];
}
