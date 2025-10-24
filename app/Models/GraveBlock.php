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

        $blocks = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

        static::creating(function ($model) use ($blocks) {
            $model->sequence = GraveBlock::where('cluster_id', $model->cluster_id)->max('sequence') + 1;
            $model->name = $blocks[($model->sequence - 1) % count($blocks)];
            $model->description = 'Block ' . $model->name;
        });
    }
}
