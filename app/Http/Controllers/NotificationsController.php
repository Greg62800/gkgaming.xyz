<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Notification;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class NotificationsController extends Controller
{

    public function index()
    {
        $notifications = Auth::user()->Notifications()->paginate(5);
        Auth::user()->unreadNotifications()->get()->markAsRead();
        return view('notifications.index', compact('notifications'));
    }


    public function read($id)
    {
        $notification = Auth::user()->unreadNotifications()->find($id);
        if($notification) {
            $notification->markAsRead();
        }
        return redirect()->route('profil.view');
    }

    public function show($article_id, $notif_id)
    {
        $article = Blog::where('id', $article_id)->first();
        $notification = Auth::user()->Notifications()->find($notif_id);
        if($notification) {
            $notification->markAsRead();
            return redirect($article->url);
        }
    }

    public function show_article($article_id, $notif_id)
    {
        $article = Blog::where('id', $article_id)->first();
        $notification = Auth::user()->Notifications()->find($notif_id);
        if($notification) {
            $notification->markAsRead();
            return redirect($article->url);
        }
    }

    public function unRead($id)
    {
        $notification = Auth::user()->Notifications()->find($id);
        if($notification) {
            $notification->markAsUnread();
        }
        return redirect()->back()->with('success', 'La notification à bien été marquer comme non lu');
    }

    public function isRead($id)
    {
        $notification = Auth::user()->Notifications()->find($id);
        if($notification) {
            $notification->markAsRead();
        }
        return redirect()->back()->with('success', 'La notification à bien été marquer comme lu');
    }

    public function readAll()
    {
        $notification = Auth::user()->Notifications()->get();
        if($notification) {
            $notification->markAsRead();
        }
        return redirect()->back()->with('success', 'Toutes les notifications ont bien été marquer comme lu');
    }
}
