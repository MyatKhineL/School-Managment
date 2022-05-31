<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            "id_no" => "required|min:2|max:255|unique:users,id_no",
            "name" => "required",
            'email' => 'required|unique:users,email',
            'password' => 'required|min:4|max:255',
            'phone' => 'required|min:9|max:11|unique:users,phone',
            'nrc' => 'required|min:3|unique:users,nrc_number',
            "mname" => "required",
            "fname" => "required",
            'birthday' => 'required|date',
            'date_of_join' => 'required|date',
            "gender" => "required",
            "profile_photo" => "nullable|mimes:png,jpg|max:5000",
            "usertype" => "required",
            "department_id" => "required",
            "address" => "nullable|min:3|max:255",
        ];
    }
}
