<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class CompanyAddress extends Model
{
    use HasFactory, HasApiTokens;
    protected $fillable = ["company_id", "address_line_1", "address_line_2", "city", "parish"];
}
