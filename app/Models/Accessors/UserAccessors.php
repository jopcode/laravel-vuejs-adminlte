<?php
namespace App\Models\Accessors;

trait UserAccessors
{
    /**
     * Return profile image with full url
     *
     * @param string $image
     * @return string
     */
    public function getProfileImageAttribute($image)
    {
        if( ! $image ) {
            $image = 'default-profile.jpg';
        }

        return asset('images/'.$image);
    }
}