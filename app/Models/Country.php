<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        "name"
    ];

    protected $casts = [
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];

    public function user(): HasOneThrough
    {
        return $this->hasOneThrough(
            User::class,
            Profile::class,
            'country_id',
            'id',
            'id',
            'user_id'
        );
    }
}