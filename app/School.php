<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = ['name', 'year', 'medium'];

    public function admins()
    {
        return $this->hasMany('App\User')->where('role', 'admin');
    }
}
