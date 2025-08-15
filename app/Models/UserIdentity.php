<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class UserIdentity extends Model
{
    protected $guarded = [];

    /**
     * @return MorphTo
     */
    public function user(): MorphTo
    {
        return $this->MorphTo(__FUNCTION__, 'model_type', 'model_id');
    }
}
