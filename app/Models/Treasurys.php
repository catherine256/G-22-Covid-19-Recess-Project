<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treasurys extends Model
{
    use HasFactory;

    protected $table = 'treasury';

    protected $guarded = [];
}
