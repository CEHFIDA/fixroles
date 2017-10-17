<?php

namespace selfreliance\fixroles\Contracts;

use Illuminate\Database\Eloquent\Model;

interface HasRole
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     * @param string $role
     * @return model role
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
     * @return bool|null
     */
    public function attachRole($role);

    /**
     * Detach role from a user.
     *
     * @return bool
     */
    public function detachRole($id);

    /**
     * Check if the user role have $prefix
     *
     * @param string $prefix
     * @return bool
     */
    public function checkRole($prefix);
}
