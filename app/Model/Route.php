<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    public $timestamps = false;
    protected $fillable = ['fly_to', 'fly_from'];
}
