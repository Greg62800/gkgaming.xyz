<?php

namespace App\Notifications;

use App\Blog;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewArticles extends Notification
{
    use Queueable;
    /**
     * @var Blog
     */
    private $blog;

    /**
     * Create a new notification instance.
     *
     * @param Blog $blog
     */
    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
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

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id' => $this->blog->id,
            'name' => $this->blog->name,
            'author' => $this->blog->user->name
        ];
    }

    public static function toId($data)
    {
        return $data['id'];
    }

    public static function toText($data)
    {
        return "Nouvel article disponible \"" . $data['name'] . "\"";
    }
}
