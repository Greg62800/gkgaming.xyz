<?php

namespace App\Notifications;

use App\Blog;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewComments extends Notification
{
    use Queueable;
    /**
     * @var Blog
     */
    private $blog;
    /**
     * @var User
     */
    private $user;

    /**
     * Create a new notification instance.
     *
     * @param Blog $blog
     * @param $user
     */
    public function __construct(Blog $blog, $user)
    {
        $this->blog = $blog;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'name_comments' => $this->user['name'],
            'id' => $this->blog->id
        ];
    }

    public static function toUrl($data)
    {
        return $data['id'];
    }

    public static function toText($data)
    {
        return $data['name_comments'] . " a commenté votre article";
    }
}
