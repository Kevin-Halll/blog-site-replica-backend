<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;

class CompanyPhoto extends Model
{
    use HasFactory, SoftDeletes, HasApiTokens;

    protected $fillable = [
        'user_id',
        'company_id',
        'review_id', 
        'file_path', 
        'caption', 
        'tags',
        // 'category'
    ];
}
