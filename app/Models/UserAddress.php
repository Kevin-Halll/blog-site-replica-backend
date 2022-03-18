<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class UserAddress extends Model
{
    use HasFactory, HasApiTokens;
    protected $fillable = ["user_id", "address_line_1", "address_line_2", "city", "parish"];
}
