<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Computer extends Model
{
    protected $table = 'computers';

    protected $fillable = [
        'model'
    ];

    public function computable(): MorphTo
    {
        return $this->morphTo();
    }
}
