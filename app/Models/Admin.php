<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPasswordAdminNotification as ResetPasswordNotification;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The users that belong to the role.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_admins', 'admin_id', 'role_id');
    }


    /**
     * Checks if User has access to $permissions.
     *
     * @param type
     * @return void
     */
    public function hasAccess(array $permissions) : bool
    {
        foreach ($this->roles as $role) {
            if ($role->hasAccess($permissions)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Block comment
     *
     * @param type
     * @return void
     */
    public function inRole(string $roleSlug)
    {
        return $this->roles->where('slug', $roleSlug)->count() == 1;
    }

    /**
   * Send the password reset notification.
   *
   * @param  string  $token
   * @return void
   */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
