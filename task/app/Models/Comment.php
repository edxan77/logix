<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'user_id',
        'text'
    ];

    public function news(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'articles_comments', 'articles_id', 'comments_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
