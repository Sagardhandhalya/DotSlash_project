<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = ['id', 'name', 'medium', 'year'];

    public function departments()
    {
        return $this->hasMany('App\Department');
    }

    public function teachers()
    {
        return $this->hasMany('App\User')->where('role', 'teacher');
    }

    public function students()
    {
        return $this->hasMany('App\User')->where('role', 'student');
    }

    public function admins()
    {
        return $this->hasMany('App\User')->where('role', 'admin');
    }

    public function classes()
    {
        return $this->hasMany('App\Myclass');
    }


}
