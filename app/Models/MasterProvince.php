<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterProvince extends Model
{
    /**
     * guarded
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * cities
     *
     * @return HasMany
     */
    public function cities(): HasMany
    {
        return $this->hasMany(MasterCity::class);
    }
}
