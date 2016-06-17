<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clothes extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id', 'size_clothes', 'size_foot'];
    protected $hidden = ['id', 'user_id'];
    public function getUser()
    {
        return $this->belongsToMany(User::class);
    }
}
