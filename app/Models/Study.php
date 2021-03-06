<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    public $timestamps = false;
    public $fillable = ['user_id','place_name','time_start','time_stop','group'];
    public $hidden = ['user_id'];
    protected $dates = ['time_start','time_stop'];
    
    public function getUser()
    {
        return $this->belongsToMany(User::class);
    }
    public function getStudyUniversity()
    {
        return $this->hasOne(Study_university::class);
    }
}
