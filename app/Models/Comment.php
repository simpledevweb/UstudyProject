<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'content'
    ];
    
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

}