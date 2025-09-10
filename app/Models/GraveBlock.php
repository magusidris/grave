<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GraveBlock extends Model
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
            $model->sequence = GraveBlock::where('cluster_id', $model->cluster_id)->max('sequence') + 1;
        });
    }
}
