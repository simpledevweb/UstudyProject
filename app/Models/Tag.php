<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable = [
        "name",
    ];

    protected $casts = [
        "created_at" => "datetime",
        "updated_at" => "datetime",
    ];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, table: 'post_tag', foreignPivotKey: 'tag_id', relatedPivotKey: 'post_id', parentKey: 'id', relatedKey: 'id');
    }

}