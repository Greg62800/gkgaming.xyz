<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 * Date: 01/08/2018
 * Time: 13:53
 */

namespace Badge\Notifications;


use App\User;
use Badge\Blog;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewArticle extends Notification
{

    use Queueable;

    /**
     * @var User
     */
    private $user;

    public function __construct(Blog $user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'name' => $this->user->name
        ];
    }

    public static function toText($data)
    {
        return "Un article a été posté " . $data['name'];
    }

}