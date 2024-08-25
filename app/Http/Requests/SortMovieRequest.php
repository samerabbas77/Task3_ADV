<?php

namespace App\Http\Requests;

use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class SortMovieRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'ASC'    =>  ['required',"boolean"],
        ];
    }


    public function messages()
    {
        return [
            'ASC.required' => 'Please provide your name.',
            'ASC.boolean' => 'The email address must be a valid email address.',
        ];
    }

    }

