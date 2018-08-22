<?php
namespace Badge;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{

    public $guarded = [];
    public $timestamps = false;

    public function authorized()
    {
        if(\Auth::user()) {
            return true;
        }
    }

    public function unlocks()
    {
        return $this->hasMany(BadgeUnlock::class);
    }

    public function isUnlockedFor(User $user)
    {
        return $this->unlocks()
            ->where('user_id', $user->id)
            ->exists();
    }

    public function unlockActionFor(User $user, $action, $count = 0)
    {
        $badge = $this->newQuery()
            ->where('action', $action)
            ->where('action_count', $count)->first();
        if($badge && !$badge->isUnlockedFor($user)) {
            $user->badges()->attach($badge);
            return $badge;
        }
        return null;
    }
}