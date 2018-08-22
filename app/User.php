<?php

namespace App;

use Badge\Badgeable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;
    use Badgeable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $_roles = [
        1 => 'admin',
        2 => 'user'
    ];

    public function isAdmin() {
      $roles = User::with('roles')->where('id', auth()->user()->id)->first();
      if($roles->role === 'admin') {
          return true;
      }
    }

    public function roles()
    {
      return $this->belongsTo('App\Role');
    }

    public function getAvatarFileAttribute() {
        if(empty($this->avatar)) {
            return "https://www.gravatar.com/avatar/" . md5($this->email);
        }else {
            return "/img/avatars/" . $this->avatar;
        }
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function articles()
    {
        return $this->hasMany(Blog::class);
    }

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = \Hash::make($password);
    }
}
