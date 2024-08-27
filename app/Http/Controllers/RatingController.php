<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Services\RatingService;
use App\Http\Requests\showRatingRequest;
use App\Http\Requests\storeRatingRequest;
use App\Http\Requests\updateRatingRequest;
use App\Http\Requests\updateeRatingRequest;

class RatingController extends Controller
{
    protected $ratingService;

      /**
     *set the service to use it in the Controller
     * @param \App\Services\RatingService $ratingService
     */
    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService;
    } 

    // ----------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------
    /**
     *  Return all the ratings of all movies
     * @return mixed
     */
    public function index()
    {
        try{
                $Ratings = Rating::paginate(); 
        
                return $this->ratingService->indexRating($Ratings);
                }catch(\Exception $e){
                    return response("something happend :".$e,400);
            }
    }
    // ----------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------
    /**
     *  store a Rating
     * @param \App\Http\Requests\storeRatingRequest $request
     * @return mixed
     */
    public function store(storeRatingRequest $request)
    {
        try{
            $request->validated();
          
            return $this->ratingService->storeRating($request);
           }catch(\Exception $e)
           {
               return response("something happend while store the data : ".$e,400);
           }
    }
   // ----------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------
   
    /**
     * * Show  all Ratings for specific movie
     * @param \App\Http\Requests\showRatingRequest $request
     * @return mixed|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show( showRatingRequest $request )
    {
        try{
           return $this->ratingService->showRating($request);
        }catch(\Exception $e)
        {
            return response("something happend while Shing the Movie : ".$e,400);
        }
    }

   // ----------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------
    
    /**
     * update a rating by its id
     * @param \App\Http\Requests\updateRatingRequest $request
     * @param \App\Models\Rating $rating
     * @return mixed|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(updateRatingRequest $request, Rating $rating)
    {
        try{
            $request->validated();

            return $this->ratingService->updateRating( $request,$rating);
            }catch(\Exception $e)
            {
                return response("something happend while Update the data : ".$e,400);
            }
    }
   // ----------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------
    
    /**
     * Delete a rating by its id
     * @param \App\Models\Rating $rating
     * @return  mixed|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy(Rating $rating)
    {
        try{
            return $this->ratingService->deleteRating($rating);
            }catch(\Exception $e)
            {
                return response("something happend while Deleting the data : ".$e,400);
            }
    }
}
