<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPhoto extends Model
{
    use HasFactory, HasApiTokens;

    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'file_path', 
        'caption', 
    ];
}
