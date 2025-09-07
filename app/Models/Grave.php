<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Grave extends Model
{
    /**
     * guarded
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * cluster
     *
     * @return BelongsTo
     */
    public function cluster(): BelongsTo
    {
        return $this->belongsTo(GraveCluster::class, 'cluster_id');
    }

    /**
     * block
     *
     * @return BelongsTo
     */
    public function block(): BelongsTo
    {
        return $this->belongsTo(GraveBlock::class, 'block_id');
    }

    /**
     * type
     *
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(GraveType::class, 'type_id');
    }

    /**
     * boot
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->number = Grave::where('cluster_id', $model->cluster_id)
                ->where('block_id', $model->block_id)
                ->max('number') + 1;
        });
    }
}
