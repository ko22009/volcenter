<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Auth;

class User extends Auth {

    public $timestamps = false;
    protected $hidden = ['password', 'id','role_id'];
    protected $fillable = ['login', 'email', 'password', 'firstname', 'lastname', 'middlename', 'birthday','role_id'];

    public function applications() {
        return $this->hasMany(Application::class);
    }

    public function profiles() {
        return $this->hasMany(Profile::class);
    }

    public function addreses() {
        return $this->hasMany(Address::class);
    }

    public function language_level() {
        return $this->hasMany(Language_level::class);
    }

    public function study() {
        return $this->hasMany(Study::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class)->first()->name;
    }
}
