<?php

namespace selfreliance\fixroles\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use DB;
use Selfreliance\fixroles\Models\Role;

trait HasRole
{
    /**
     * Property for caching role.
     *
     * @var \Illuminate\Database\Eloquent\Collection|null
     */
    protected $role;

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRole($role)
    {
        return (!$this->role) ? Role::where('id', $role)->orWhere('slug', $role)->first() : $this->role;
    }

    /**
     * Check if the user has role.
     *
     * @param string $role
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->role_id == $this->getRole($role)->id;
    }

    /**
     * Attach role to a user.
     *
     * @param string|\fixroles\Roles\Models\Role $role
     * @return bool
     */
    public function attachRole($role)
    {
        $this->role = null;

        $role = $this->getRole($role);
        if($role->id)
        {
            $this->role_id = $role->id;
            return $this->save();
        }

        return false;
    }

    /**
     * Detach role from a user.
     *
     * @param string|\fixroles\Roles\Models\Role $role
     * @return bool
     */
    public function detachRole($role)
    {
        $this->role = null;

        if($this->role_id == $this->getRole($role)->id)
        {
            $this->role_id = null;
            return $this->save();
        }

        return false;
    }

    /**
     * Check if the user role have $prefix
     *
     * @param string $prefix
     * @return bool
     */
    public function checkRole($prefix)
    {
        $role = $this->getRole($this->role_id);
        $pages = json_decode($role->accessible_pages);
        if(!is_null($role) && in_array($prefix, $pages)) return true;

        return false;
    }
}
