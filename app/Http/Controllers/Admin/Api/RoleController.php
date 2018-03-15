<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\RoleRepository;
use App\Http\Resources\Admin\RoleResource;
use App\Http\Controllers\Admin\Api\BaseController;

class RoleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RoleRepository $role_repository)
    {
        $roles = $role_repository->all();

        return $this->respondWithSuccess(RoleResource::collection($roles));
    }
}
