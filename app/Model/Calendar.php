<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $table = 'calendar';
    public $timestamps = false;
    protected $fillable = ['route_id', 'price', 'date'];

    public function route()
    {
        return $this->belongsTo('App\Model\Route', 'route_id');
    }
}
