<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Myclass extends Model
{
    protected $fillable = ['school_id', 'number', 'group'];

    public function sections()
    {
        return $this->hasMany('App\Section', 'class_id', 'id');
    }
}
