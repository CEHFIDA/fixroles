<?php

namespace selfreliance\fixroles\Traits;

use Illuminate\Database\Eloquent\Model;
use Selfreliance\fixroles\Models\Role;
use Illuminate\Support\Str;

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
        return (!$this->role) ? Role::where('id', $role)->orWhere('name', $role)->orWhere('slug', $role)->first() : $this->role;
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
     * @param string $role
     * @return bool
     */
    public function attachRole($role)
    {
        $role = $this->getRole($role);
        if($this->role_id != $role->id)
        {
            $this->role = null;
            $this->role_id = $role->id;
            return $this->save();
        }

        return false;
    }

    /**
     * Detach role from a user.
     *
     * @param string $role
     * @return bool
     */
    public function detachRole($role)
    {
        $role = $this->getRole($role);
        if($this->role_id == $role->id)
        {
            $this->role = null;
            $this->role_id = -1;
            return $this->save();
        }

        return false;
    }

    /**
     * Check if the user role has the specified prefix
     *
     * @param string $prefix
     * @return pages/bool
     */
    public function checkRole($prefix, $return_pages)
    {
        $role = $this->getRole($this->role_id);
        if($role)
        {
	        $pages = json_decode($role->accessible_pages);
            $brokenPiece = explode('/', $prefix);
	        $prefix = $brokenPiece[1] ?? $brokenPiece[0];
	        if(in_array($prefix, $pages)) return ($return_pages) ? $pages : true;
        }

        return false;
    }
}