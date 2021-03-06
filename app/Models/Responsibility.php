<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Responsibility extends Model
{
    protected $fillable = ['position','task','count'];
    public $timestamps = false;
    public function getResponsibilitiesEvents()
    {
        return $this->hasMany(Responsibility_event::class);
    }
}
