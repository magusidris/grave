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
     * boot
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->sequence = Grave::where([
                ['site_id', $model->site_id],
                ['cluster_id', $model->cluster_id],
                ['block_id', $model->block_id],
            ])->max('sequence') + 1;

            $cluster = \App\Models\GraveCluster::find($model->cluster_id);
            $block = \App\Models\GraveBlock::find($model->block_id);
            $type = \App\Models\GraveType::find($model->type_id);

            $siteName = $cluster && $cluster->site ? mb_strtoupper($cluster->site->name) : '';
            $clusterName = $cluster ? $cluster->name : '';
            $blockName = $block ? $block->name : '';
            $typeName = $type ? mb_strtoupper($type->name) : '';

            $siteCode = mb_substr(preg_replace('/[^A-Z]/u', '', $siteName), 0, 2);
            $clusterCode = preg_replace('/[^A-Z]/u', '', ucwords($clusterName));
            $sequencePadded = str_pad($model->sequence, 3, '0', STR_PAD_LEFT);

            $model->code = $siteCode . $clusterCode . $blockName . $typeName[0] . $sequencePadded;
        });
    }

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
}
