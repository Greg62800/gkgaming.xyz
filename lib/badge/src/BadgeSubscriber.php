<?php
namespace Badge;

use App\User;
use Badge\Notifications\BadgeUnlocked;
use Auth;

class BadgeSubscriber
{

    /**
     * @var Badge
     */
    private $badge;

    public function __construct(Badge $badge)
    {
        $this->badge = $badge;
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher $events
     * @return bool
     */
    public function subscribe($events)
    {
        $events->listen('eloquent.saved: App\Comment', [$this, 'onNewComment']);
        $events->listen('eloquent.saved: App\Blog', [$this, 'onNewArticle']);
    }

    public function notifyBadgeUnlock($user, $badge)
    {
        if($badge) {
            $user->notify(new BadgeUnlocked($badge));
        }
    }

    public function onNewComment($comment)
    {
        if(Auth::check()) {
            $user = $comment->user;
            $comments_count = $user->comments()->count();
            $badge = $this->badge->unlockActionFor($user, 'comments', $comments_count);
            $this->notifyBadgeUnlock($user, $badge);
        }
    }

    public function onNewArticle($article)
    {
        if(Auth::check()) {
            $user = $article->user;
            $comments_count = $user->articles()->count();
            $badge = $this->badge->unlockActionFor($user, 'blog', $comments_count);
            $this->notifyBadgeUnlock($user, $badge);
        }
    }
}