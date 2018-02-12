<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Support\Carbon;

class BaseController extends Controller
{
	/**
	 * Class contructor
	 */
	public function __construct()
	{
		// format all carbon instances to datetime
		// when returning from api
		Carbon::serializeUsing(function($carbon){
			return $carbon->toDateTimeString();
		});
	}

	/**
	 * Respond with success status (200)
	 *
	 * @param array $data
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function respondWithSuccess($data = [])
	{
		return response()->json($data, 200);
	}

	/**
	 * Respond with created successfully
	 *
	 * @param array $data
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function respondWithCreatedSuccessfully($data = [])
	{
		$data = empty($data) ? [] : ['data' => $data];

		return response()->json($data, 201);
	}

	/**
	 * Respond with conflict
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function respondWithConflict()
	{
		return response()->json([], 409);
	}

	/**
	 * Respond with not acceptable
	 *
	 * @param array $data
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function respondWithNotAcceptable($data = [])
	{
		return response()->json($data, 406);
	}

	/**
	 * Respond with validation error
	 *
	 * @param array $errors
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function respondWithValidationError($errors = [])
	{
		$data = [
			"message" => "The given data was invalid.",
			"errors" => $errors
		];

		return response()->json($data, 422);
	}

	/**
	 * Respond with not found
	 *
	 * @param array $data
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function respondWithNotFound($data = [])
	{
		$data = empty($data) ? [] : ['data' => $data];

		return response()->json($data, 404);
	}
}