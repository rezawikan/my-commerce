<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;

class Role extends Model
{
    /*
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['name', 'slug', 'permissions'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions' => 'array',
    ];

    /**
     * The roles that belong to the user.
     */
    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'role_admins');
    }

    /**
     * Checking Access in users
     *
     * @param array permissions of access
     * @return void
     */
    public function hasAccess(array $permissions) : bool
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission)) {
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
    public function hasPermission(string $permission) : bool
    {
        return $this->permissions[$permission] ?? false;
    }
}
