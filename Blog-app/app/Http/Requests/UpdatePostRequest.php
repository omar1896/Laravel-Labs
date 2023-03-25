<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title'=>['required','min:3','string', "unique:posts,title,".$this->post],
            'description'=>['required','min:10','string'],
            'post_creator'=>['exists:posts,user_id'],
            'photo'=>['required','mimes:png,jpeg']
        ];
    }
}
