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
        if( $image ) {
            return asset('storage/images/profile/'.$image);
        }

        return asset('images/default-profile.jpg');
    }
}