<?php

namespace App\Http\Requests;
use App\Rules\MatchOldPassword;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfilePasswordRequest extends FormRequest
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
            "current_password" => ['required', new MatchOldPassword()],
            "new_password" => ['required', 'min:5'],
            "new_confirm_password" => ['same:new_password']
        ];
    }
}
