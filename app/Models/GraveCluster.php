<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function site(): BelongsTo
    {
        return $this->belongsTo(GraveSite::class, 'site_id');
    }
}
