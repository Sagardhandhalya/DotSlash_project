<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['class_id', 'user_id', 'room', 'name'];

    public function class()
    {
        return $this->belongsTo('App\Myclass');
    }

    public function courses()
    {
        return $this->hasMany('App\Course');
    }

    public function students()
    {
        return $this->hasMany('App\User')->where('role', 'student');
    }
}
