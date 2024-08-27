<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class updateRatingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $rating = $this->route('rating'); // Retrieve the Rating instance from the route

        // Check if the authenticated user owns the rating
        return Auth::check() && Auth::id() == $rating->user_id;
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'rating' => 'required|integer|min:1|max:5', // Integer between 1 and 5
            'review' => 'nullable|string|max:1000', // Optional text, max 1000 characters
        ];
    }
}
