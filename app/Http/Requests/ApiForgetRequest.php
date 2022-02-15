<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiForgetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email|max:50',
            'password' => 'required|min:6',
            "same_password"=>"required|same:password"
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ],400));
    }

    public function messages() //OPTIONAL
    {
        return [
            'email.required' => 'Почта обязательна для заполнения',
            'email.email' => 'Email не валиден',
            "password.required"=>"Поле пароль обязателен для заполнения"
        ];
    }
}
