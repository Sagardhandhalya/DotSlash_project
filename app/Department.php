<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['id', 'name', 'school_id'];

    public function teachers()
    {
        return $this->hasMany('App\User')->where('role', 'teacher');
    }
}