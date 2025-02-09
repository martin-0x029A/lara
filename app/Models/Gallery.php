<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    // Define which attributes are mass assignable.
    protected $fillable = [
        'name',
        'description',
        'image', // This will store the base64 encoded image data.
    ];
} 