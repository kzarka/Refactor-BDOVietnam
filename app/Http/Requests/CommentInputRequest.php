<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidateBase64;
use App\Rules\ContentHasUrl;

class CommentInputRequest extends FormRequest
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
            'name' => ['nullable', 'string', 'max:40'],
            'website' => 'nullable|max:150',
            'email'    => 'nullable|email|max:100' . ($this->id != null ? ",$this->id" : ''),
            'comment' => ['required', 'max:300', new ContentHasUrl]
        ];
    }
}
