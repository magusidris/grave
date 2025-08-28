<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MasterCity extends Model
{
    /**
     * guarded
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * province
     *
     * @return BelongsTo
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(MasterProvince::class);
    }


    /**
     * subdistricts
     *
     * @return HasMany
     */
    public function subdistricts(): HasMany
    {
        return $this->hasMany(MasterSubdistrict::class);
    }
}
