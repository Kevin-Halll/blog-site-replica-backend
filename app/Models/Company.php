<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Company extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = "companies";

    protected $fillable = [
        "is_claimed",
        "name",
        "description",
        "email",
        "phone",
        "website",
        "menu_url",
        "category_ids",
        "amenities",
        "tags",
    ];

    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
