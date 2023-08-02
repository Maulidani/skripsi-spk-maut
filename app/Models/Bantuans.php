<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bantuans extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'detail', 'category_id', 'created_at', 'updated_at'];

    protected $table = 'bantuans';
}
