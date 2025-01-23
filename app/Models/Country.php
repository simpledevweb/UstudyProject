<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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
    /**
     * Summary of posts
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function posts(): HasManyThrough
    {
        return $this->hasManyThrough(
            Post::class,
            User::class,
            'country_id',
            'user_id',
            'id',
            'id'
        );
    }
}
