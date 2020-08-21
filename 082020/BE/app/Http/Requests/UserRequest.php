<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => 'required|email',
            'phone' => 'max:11|min:10',
            'first_name' => 'max:20',
            'last_name' => 'max:25',
            'nickname' => 'max:30',
            'price' => 'integer',
            'hidden' => 'bolean',
            'address' => 'max:2000',
            'bio' => 'max:2000',
            'avatar' => 'mimes:jpeg,jpg,png|max:10000'
        ];
    }
}
