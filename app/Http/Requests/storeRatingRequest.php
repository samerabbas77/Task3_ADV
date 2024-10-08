<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeRatingRequest extends FormRequest
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
            'movie_title' => 'required|string|exists:movies,title', // Must be a valid movie ID
            'rating' => 'required|integer|min:1|max:5', // Integer between 1 and 5
            'review' => 'nullable|string|max:1000', // Optional text, max 1000 characters
        ];
    }
}
