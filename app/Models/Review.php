<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Review extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'user_id',
        'company_id',
        'star_rating', 
        'title', 
        'content', 
        'helpful_count',
        'not_helpful_count',
        'is_active'
    ];
}
