<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_number'
    ];
}
