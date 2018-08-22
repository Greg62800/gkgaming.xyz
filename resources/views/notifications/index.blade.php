@extends('layouts.app')

@section('content')
    <h2>Notifications</h2>
    <div class="notification_view">
        @foreach($notifications as $notification)
            <span>
                @if($notification->type === 'App\Notifications\NewArticles')
                    <a href="{{ route('notifications.show', [($notification->type)::toId($notification->data), $notification->id]) }}">
                        {{ ($notification->type)::toText($notification->data) }}
                    </a>
                @elseif($notification->type === 'App\Notifications\NewComments')
                    <a href="{{ route('notifications.show_article', [($notification->type)::toUrl($notification->data), $notification->id]) }}">
                        {{ ($notification->type)::toText($notification->data) }}
                    </a>
                @else
                    <a href="{{ route('notifications.read', $notification->id) }}">
                        {{ ($notification->type)::toText($notification->data) }}
                    </a>
                @endif
            </span>
        @endforeach
        @include('pagination.default', ['paginator' => Auth::user()->Notifications()->paginate(5)])
    </div>
@endsection