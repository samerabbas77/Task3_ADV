<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class RatingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Rating'            =>$this->rating,
            'Review'            =>$this->review,
            'Movie Title'       =>$this->movie->title,
            'User Name'         =>Auth::user()->name,
          
        ];
    }
}
