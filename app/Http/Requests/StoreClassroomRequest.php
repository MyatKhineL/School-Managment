<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassroomRequest extends FormRequest
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
            "name" => "required|min:2|max:100",
            "course_id" => "required",
            "shift_id" => "required",
            "user_id" => "required",
            "start_date" => "required",
            "end_date" => "required",
            "status" => "required",
            "description" => "required|min:3",
        ];
    }

    public function messages(){
        return [
            "course_id.required" => "The course field is required.",
            "shift_id.required" => "The shift field is required.",
            "user_id.required" => "The teacher field is required.",
        ];
    }
}
