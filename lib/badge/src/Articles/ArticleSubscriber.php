<?php

namespace Badge\Articles;


use App\User;
use Badge\Article;
use Badge\Notifications\NewArticle;
use Auth;

class ArticleSubscriber
{

    /**
     * @var Article
     */
    private $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function subscribe($events)
    {
        $events->listen('eloquent.saved: App\Blog', [$this, 'onNewArticle']);
    }

    public function notifyNewArticle($user)
    {
        $user->notify(new NewArticle(Auth::user()));
    }

    public function onNewArticle($events)
    {
        $this->notifyNewArticle($events->user);
    }

}