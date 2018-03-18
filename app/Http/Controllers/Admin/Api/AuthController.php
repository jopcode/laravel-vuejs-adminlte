<?php

namespace App\Http\Controllers\Admin\Api;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Admin\Controller;
use App\Http\Resources\Admin\AuthUserResource;
use App\Http\Requests\Admin\UploadProfileImage;
use App\Http\Controllers\Admin\Api\BaseController;
use App\Http\Requests\Admin\UpdateAuthUserRequest;

class AuthController extends BaseController
{
    /**
     * User Service
     *
     * @var UserService
     */
    protected $user_service;

    /**
     * Class constructor
     *
     * @param UserService $user_service
     */
    public function __construct(UserService $user_service)
    {
        $this->user_service = $user_service;
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = auth()->user();

        return $this->respondWithSuccess(new AuthUserResource($user));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateAuthUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAuthUserRequest $request)
    {
        $params = $request->only(['name', 'email', 'roles', 'password']);
        $user = auth()->user();

        if( empty($params['password']) ) {
            unset($params['password']);
        }

        if( $user->syncRoles($params['roles'])->update($params) ) {
            return $this->respondWithSuccess(new AuthUserResource($user));
        }

        return $this->respondWithFailure();
    }

    /**
     * Save authenticated users profile image
     *
     * @param  \Illuminate\Http\UploadProfileImage  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadProfileImage(UploadProfileImage $request)
    {
        $filename = $this->user_service->uploadProfileImage($request->get('profile_image'));

        $user = auth()->user();
        $user->update(['profile_image' => $filename]);

        return $this->respondWithSuccess(new AuthUserResource($user));
    }
}
