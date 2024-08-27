<?php

namespace App\Services;

use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\RatingResource;
use App\Models\Movie;

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

    // ----------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------

    /**
     *    Store The Rating of the specfic movie
     * @param mixed $data
     * @return mixed|\Illuminate\Http\JsonResponse
     */
   public function storeRating($request)
   {
            $movie_id = Movie::where('title','LIKE','%'.$request['movie_name'].'%')->pluck('id');
           
            // Create a new movie record
            $movie = Rating::create([
                'rating'     => $request->rating,
                'review'     => $request->review,
                'movie_id'   => $movie_id[0],
                'user_id'    => Auth::id(),
            ]);
                 
               return response()->json([
                "Data"      => new RatingResource ($movie),
                "message"   =>" Rating  successfully Created",
                "status"    =>201, 
               ]);
   }
    // ----------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------

   /**
    * Show  all Ratings for specific movie
    * @param mixed $request
    * @return mixed|\Illuminate\Http\JsonResponse
    */
   public function showRating($request)
   {
        //Get the id of the Movie    
      $movie_id = Movie::where('title','LIKE','%'.$request->movie_title.'%')->pluck('id');
      //Get all the Rating of that movie(return as array inside array we can use pluck to avoid this)
      $ratings = Rating::where('movie_id', $movie_id[0])->get();

      return response()->json([
        "Data"      =>new RatingResource( $ratings[0]),
        "message"   =>"Rating Detalies Showed Successfully",
        "status"    =>200,
      ]);
   }

    // ----------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------
   /**
    * update a Rating by its id
    * @param mixed $request
    * @param mixed $rating
    * @return mixed|\Illuminate\Http\JsonResponse
    */
   public function updateRating( $request,$rating)
   {
    //Check if the current user is the user how own the Rating
    if(Auth::id() == $rating->user_id)
       {  
            
          // Update fields conditionally
          if ($request->review != null) {
              $rating->review = $request->review;
          }
          if ($request->rating != null) {
              $rating->rating = $request->rating;
          }
          $rating->save();

          return response()->json([
            "Data"      => new RatingResource ($rating),
            "message"   =>" Rating  successfully Updated",
            "status"    =>201, 
          ]);
        }else
        {
          return response()->json("This Rating is Not Belong To You");
        }

  

   }
    // ----------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------
   /**
    * Delete a rating by its id
    * @param mixed $rating
    * @return mixed|\Illuminate\Http\JsonResponse
    */
   public function deleteRating($rating)
   {
    $data = Rating::findOrFail($rating->id);
    if($data)$rating->delete();

    return response()->json([
     "Data"      => new RatingResource ($data),
     "message"   =>" Rating  successfully Deleted",
     "status"    =>200,
    ]);
   }

}