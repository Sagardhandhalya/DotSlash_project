<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'time', 'user_id', 'teacher_id', 'section_id', 'class_id', 'school_id'];

    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function teacher()
    {
        return $this->belongsTo('App\User');
    }
}
