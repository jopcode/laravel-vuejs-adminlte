<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository
{
    /**
     * Get all roles soreted by name
     *
     * @return Collection
     */
    public function all()
    {
        return Role::orderBy('name')->get();
    }
}