<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryKwbs extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'detail', 'created_at', 'updated_at'];

    protected $table = 'category_kwbs';
}
