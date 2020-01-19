<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['id' ,'course_id', 'name', 'message'];

    public function course()
    {
        return $this->belongsTo('App\Course');
    }
}
