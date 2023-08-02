<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kwbs extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'category_id', 'kecamatan', 'kelurahan', 'address', 'name_leader', 'member', 'checked', 'created_at', 'updated_at'];

    protected $table = 'kwbs';
}
