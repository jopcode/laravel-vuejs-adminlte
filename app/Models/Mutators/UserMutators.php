<?php

namespace App\Models\Mutators;

trait UserMutators
{
    /**
     * Hash password string
     *
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}