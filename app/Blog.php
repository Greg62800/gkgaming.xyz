<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Blog extends Model
{

    use Notifiable;

    protected $table = 'blog';
    protected $fillable = [
        'name',
        'slug',
        'content',
        'user_id',
        'category_id',
        'online',
        'video_url'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'blog_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getUrlAttribute() {
        return "/blog/{$this->slug}";
    }

    public static function boot() {
        parent::boot();

        static::saving(function($article) {
            if(isset($article->name)) {
                $article->slug = \Str::slug($article->name);
            }
            $article->user_id = \Auth::user()->id;
        });
    }
}
