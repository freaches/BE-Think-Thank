<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Lavavel\Eloquent\Model;

class Avatar extends Model
{
    use HasFactory;

    protected $connection = "mongodb";
}
