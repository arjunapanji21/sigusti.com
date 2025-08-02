<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StandarBb extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the age range associated with the standard weight.
     */
    public function usiaBayi()
    {
        return $this->belongsTo(UsiaBayi::class, 'usia_bayi_id');
    }

    /**
     * Get the wilayah associated with the standard weight.
     */
    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'wilayah_id');
    }
}
