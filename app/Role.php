<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'label'];

    /**
     * A role may be given various permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Grant the given permission to a role.
     *
     * @param  Permission $permission
     *
     * @return mixed
     */
    public function givePermissionTo(Permission $permission)
    {
        return $this->permissions()->save($permission);
    }

    /**
     * Change activity log event description
     *
     * @param string $eventName
     *
     * @return string
     */
    public function getDescriptionForEvent($eventName)
    {
        return __CLASS__ . " model has been {$eventName}";
    }
	
	public function main_permission()
    {
        return $this->belongsToMany(Permission::class)->where('parent_id', 0);
    }
	
	public function scopeLower($q, $user = null)
    {
        //done lower means higher
        if (is_null($user)) {

            if (\Auth::check()) {

                $user = \Auth::user();

                $min = $user->roles()->min('id');

            } else {

                $min = 0;

            }
        } else {
            $min = $user->roles()->min('id');
        }

        return $q->where('id', '>=', $min);
    }
}
