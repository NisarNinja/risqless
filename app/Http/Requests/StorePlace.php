<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlace extends FormRequest
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
            'name' => 'bail|required',
            'photo' => 'bail|required',
            'address' => 'bail|required',
            'longitude' => 'bail|required',
            'latitude' => 'bail|required',
            'phone' => 'bail|required|unique:places',
            'user_id' => 'bail|required',
            'category_id' => 'bail|required',
            'from_time' => 'bail|required',
            'to_time' => 'bail|required',
        ];
    }
}
