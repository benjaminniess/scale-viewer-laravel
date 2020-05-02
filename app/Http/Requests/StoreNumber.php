<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNumber extends FormRequest
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
            'new_number'       => [ 'required', 'integer' ],
            'new_number_title' => 'required',
            'new_number_description' => 'required'
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
            'new_number.required' => "Please enter a number",
            'new_number.integer' => "Please enter a valid number",
            'new_number_title.required' => "Please enter a title",
            'new_number_description.required' => "Please enter a description"
        ];
    }
}
