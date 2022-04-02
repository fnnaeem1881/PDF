<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pdf extends Model
{
    protected $fillable = [
        'user_id',
        'text_1',
        'text_2',
        'file',
    ];
}
