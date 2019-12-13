<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidateBase64;

class UserInputRequest extends FormRequest
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
        if($this->method() == 'GET') return [];
        return [
            'username' => 'required|string|max:255|alpha_dash|unique:users,id' . ($this->id != null ? ",$this->id" : ''),
            'email'    => 'required|email|max:200|unique:users,id' . ($this->id != null ? ",$this->id" : ''),
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
