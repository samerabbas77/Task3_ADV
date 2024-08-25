<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Services\RatingService;
use App\Http\Requests\storeRatingRequest;
use App\Http\Requests\updateRatingRequest;
use App\Http\Requests\updateeRatingRequest;

class RatingController extends Controller
{
    protected $RatingService;

      /**
     *set the service to use it in the Controller
     * @param \App\Services\RatingService $RatingService
     */
    public function __construct(RatingService $RatingService)
    {
        $this->RatingService = $RatingService;
    } 


    /**
     * Summary of index
     * @return mixed
     */
    public function index()
    {
        try{
                $Ratings = Rating::paginate(); 
        
                return $this->RatingService->indexRating($Ratings);
                }catch(\Exception $e){
                    return response("something happend :".$e,400);
            }
    }

    
    public function store(storeRatingRequest $request)
    {
        try{
            $request->validated();
          
            return $this->RatingService->storeRating($request);
           }catch(\Exception $e)
           {
               return response("something happend while store the data : ".$e,400);
           }
    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateRatingRequest $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
