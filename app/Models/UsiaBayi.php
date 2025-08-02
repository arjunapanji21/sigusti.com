<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsiaBayi extends Model
{
    protected $table = 'usia_bayis';
    protected $fillable = ['rentang'];
    public $timestamps = false;

    public function perkembangan()
    {
        return $this->hasMany(Perkembangan::class);
    }
}
