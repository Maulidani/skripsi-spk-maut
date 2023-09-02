<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'bantuan_id', 'kwb_id', 'rank', 'score', 'version', 'created_at', 'updated_at'];

    protected $table = 'results';
}
