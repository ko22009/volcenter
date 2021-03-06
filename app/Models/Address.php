<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public $timestamps = false;
    protected $hidden = ['user_id'];
    protected $fillable = ['user_id','country','city','street','house','ext','flat'];
    public function getUser()
    {
        return $this->belongsToMany(Users::class);
    }
}
