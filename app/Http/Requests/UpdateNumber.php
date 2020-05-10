<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNumber extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->is_author($this->route('board'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'update_number' => [ 'required', 'integer' ],
            'update_number_title' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'update_number.required' => "Please enter a number",
            'update_number.integer' => "Please enter a valid number",
            'update_number_title.required' => "Please enter a title",
            'update_number_description.required' => "Please enter a description"
        ];
    }
}
