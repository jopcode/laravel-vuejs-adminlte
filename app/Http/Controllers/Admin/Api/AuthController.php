<?php

namespace App\Http\Controllers\Admin\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Http\Resources\Admin\AuthUserResource;
use App\Http\Controllers\Admin\Api\BaseController;

class AuthController extends BaseController
{
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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
}
