<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    const TYPE_BLOG = 'blog';
    const TYPE_NEWS = 'news';

    protected $table = 'articles';

    protected $fillable = [
        'user_id',
        'title',
        'image',
        'description',
        'tags',
        'type',
    ];

    public function comments(): BelongsToMany
    {
        return $this->belongsToMany(Comment::class, 'articles_comments', 'article_id', 'comment_id');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class, 'article_id', 'id');
    }
}
