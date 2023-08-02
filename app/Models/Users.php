<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'username', 'password', 'session', 'created_at', 'updated_at'];

    protected $table = 'users';
}
