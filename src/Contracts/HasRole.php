<?php

namespace selfreliance\fixroles\Contracts;

use Illuminate\Database\Eloquent\Model;

interface HasRole
{
    /**
     * Get a role where id, slug or name is equal to the $role
     *
     * @param string $role
     * @return object role
     */
    public function getRole($role);

    /**
     * Check if the user has role.
     *
     * @param string $role
     * @return bool
     */
    public function hasRole($role);

    /**
     * Attach role to a user.
     *
     * @param string $role
     * @return bool
     */
    public function attachRole($role);

    /**
     * Detach role from a user.
     *
     * @param string $role
     * @return bool
     */
    public function detachRole($role);

    /**
     * Check if the user role has the specified prefix
     *
     * @param string $prefix
     * @param bool $return_pages
     * @return bool
     */
    public function checkRole($prefix, $return_pages);
}
