<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GraveBlock extends Model
{
    /**
     * guarded
     *
     * @var array
     */
    protected $guarded = [];

    public function cluster(): BelongsTo
    {
        return $this->belongsTo(GraveCluster::class, 'cluster_id');
    }
}
