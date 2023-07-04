<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password','status','utype','week_attendance_in','week_attendance_out','verified'
    ];
	
	protected $appends = ['full_name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
	public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }
	public function getFullNameAttribute()
    {
		return $this->first_name;
	}
	
	public function activetickets()
    {
        return $this->hasMany('App\Tickets', 'user_id', 'id')->where('status', 'open');
    }
	public function closedtickets()
    {
        return $this->hasMany('App\Tickets', 'user_id', 'id')->where('status', 'closed');
    }
	
}
