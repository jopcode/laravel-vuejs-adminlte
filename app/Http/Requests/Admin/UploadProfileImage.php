<?php

namespace App\Http\Requests\Admin;

use App\Rules\Base64Types;
use Illuminate\Foundation\Http\FormRequest;

class UploadProfileImage extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'profile_image' => [
                'required',
                new Base64Types(['jpg','jpeg','png'])
            ]
        ];
    }
}
