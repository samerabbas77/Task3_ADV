<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Response;
use App\Services\MovieService;
use App\Http\Resources\MovieResource;
use App\Http\Requests\SortMovieRequest;
use App\Http\Requests\storeMovieRequest;
use App\Http\Requests\updateMovieRequest;
use App\Http\Requests\SearchMoviesRequest;

class MovieController extends Controller
{
    protected $movieService;

    /**
     *set the service to use it in the Controller
     * @param \App\Services\MovieService $movieService
     */
    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    } 

    // ----------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------
   
    /**
     * Return all the Movie
     * 
     *@return mixed
     */
    public function index()
    {
    try{
       $movies = Movie::paginate(); 
       
       return $this->movieService->indexMovie($movies);
    }
    catch(\Exception $e){
        return response("something happend :".$e,400);
                       }
    }
    // ----------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------
    
    /**
     * Store the movie
     * @param \App\Http\Requests\storeMovieRequest $request
     * 
     */
    public function store(storeMovieRequest $request)
    {
        try{
         $request->validated();
       
         return $this->movieService->storeMovie($request);
        }catch(\Exception $e)
        {
            return response("something happend while store the data : ".$e,400);
        }
    }
    // ----------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------

    /**
     * Show single Movie
     * @param \App\Models\Movie $movie
     * 
     */
    public function show(Movie $movie)
    {
        try{
               return $this->movieService->showMovie($movie);
            }catch(\Exception $e)
    {
        return response("something happend while Shing the Movie : ".$e,400);
    }
    }
    // ----------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------

    /**
     * Summary of update
     * @param \App\Http\Requests\updateMovieRequest $request
     * @param \App\Models\Movie $movie
     *
     */
    public function update(updateMovieRequest $request, Movie $movie)
    {
            try{
        $request->validated();

        return $this->movieService->updateMovie( $movie,$request);
        }catch(\Exception $e)
        {
            return response("something happend while Update the data : ".$e,400);
        }
    }
    // ----------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------

    /**
     * Delete a Movie
     * @param \App\Models\Movie $movie
     *
     */
    public function destroy(Movie $movie)
    {
        try{
            return $this->movieService->deleteMovie($movie);
            }catch(\Exception $e)
            {
                return response("something happend while Deleting the data : ".$e,400);
            }
    }
    // ------------------------------------------END OF CRUD------------------------------------
    //-----------------------------------------------------------------------------------------

    /**
     * search Movie by genre OR director
     * @param \App\Http\Requests\SearchMoviesRequest $request
     * 
     */
    public function search(SearchMoviesRequest $request)
    {
        try{
             $request->validated();
          
            return $this->movieService->searchMovie($request);
        }catch(\Exception $e)
        {
            return response("Something happend while Search into the data :".$e,400);
        }
    }

    // ----------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------
    public function sort(SortMovieRequest $request)
    {
        $request->validated();
        return $this->movieService->sortMovie($request);
     
    }
}
