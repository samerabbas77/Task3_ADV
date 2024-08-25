<?php

namespace App\Services;

use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\RatingResource;

class RatingService
{
    /**
     * Return all of The Rating
     * @param mixed $data
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function indexRating($data)
    {
        return response()->json([
            "Data"      =>RatingResource::collection($data),
            "message"   =>"All Ratings  successfully sent",
            "status"    =>200,       
            ]);
    }


}