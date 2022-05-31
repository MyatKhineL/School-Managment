<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
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
        $id = $this->route('course')->id;

        return [
            "name" => "required|min:2|max:255|unique:courses,name,". $id,
            "price" => 'required',
            "description" => 'required|min:5'
        ];
    }
}
