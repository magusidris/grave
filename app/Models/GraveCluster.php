<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GraveCluster extends Model
{
    /**
     * guarded
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * boot
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->sequence = GraveCluster::max('sequence') + 1;
        });
    }
}
