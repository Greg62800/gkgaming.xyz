<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [
        'name',
        'email',
        'content',
        'blog_id',
        'parent_id',
        'user_id'
    ];

    public function blog() {
        return $this->belongsTo(Blog::class);
    }

    public function reply() {
        return $this->hasMany(Comment::class, 'parent_id')->orderBy('created_at', 'ASC');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
