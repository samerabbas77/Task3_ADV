<?php
  namespace App\Services;

use App\Http\Requests\SortMovieRequest;
use App\Models\User;
  use App\Models\Movie;
  use App\Http\Resources\MovieResource;
  

    class MovieService
    {
      /**
       * Show all of the movie
       * @param mixed $data
       * @return mixed|\Illuminate\Http\JsonResponse
       */
      public function indexMovie($data=null)
      {
        return response()->json([
        "Data"      =>MovieResource::collection($data),
        "message"   =>"All Movies  successfully sent",
        "status"    =>200,       
        ]);
      }


       /**
        * function to store a Movie
        * @param mixed $request
        * @return mixed|\Illuminate\Http\JsonResponse
        */
       public function storeMovie($request)
       {
      
        // Create a new movie record
        $movie = Movie::create([
          'title' => $request->title,
          'director' => $request->director,
          'genre' => $request->genre,
          'release_year' => $request->release_year,
          'description' => $request->description ??'No description available',
      ]);
               
         return response()->json([
          "Data"      => new MovieResource ($movie),
          "message"   =>" Movie  successfully Created",
          "status"    =>201, 
         ]);

       }

       public function showMovie(Movie $movie)
       {
        $data = Movie::find($movie->id);
        return response()->json([
          "Data"      =>new MovieResource($data),
          "message"   =>"Mvie Detalies Showed Successfully",
          "status"    =>200,
        ]);
       }

       public function updateMovie(Movie $movie, $request)
       {
          $movie = Movie::findOrFail($movie->id);
 
            // Update fields conditionally
          if ($request->title != null) {
              $movie->title = $request->title;
          }
          if ($request->director != null) {
              $movie->director = $request->director;
          }
          if ($request->genre != null) {
              $movie->genre = $request->genre;
          }
          if ($request->release_year != null) {
              $movie->release_year = $request->release_year;
          }
          if ($request->description != null) {
              $movie->description = $request->description;
          }

          $movie->save();

          return response()->json([
            "Data"      => new MovieResource ($movie),
            "message"   =>" Movie  successfully Updated",
            "status"    =>201, 
          ]);
       }
       /**
        * Delet a movie
        * @param \App\Models\Movie $movie
        * @return mixed|\Illuminate\Http\JsonResponse
        */
       function deleteMovie(Movie $movie)
       {
         $data = Movie::findOrFail($movie->id);
         if($data)$movie->delete();

         return response()->json([
          "Data"      => new MovieResource ($data),
          "message"   =>" Movie  successfully Deleted",
          "status"    =>200,
         ]);
       }

       /**
        * searchMovie by genre OR director
        * @param mixed $request
        * @return mixed|\Illuminate\Http\JsonResponse
        */
       public function searchMovie( $request)
       {
            // Ensure at least one search parameter is provided
            if (($request->genre == null) && ($request->director == null)) {
              return response()->json([
                  'error' => 'Please provide at least one search parameter: genre or director.'
              ], 400);
          }

          // Build the query
          $query = Movie::query();

          if ($request->filled('genre')) {
              $query->where('genre', 'like', '%' . $request->genre . '%');
          }

          if ($request->filled('director')) {
              $query->where('director', 'like', '%' . $request->director . '%');
          }

          // Execute the query and get the results
          $movies = $query->get();
          
          if(!empty($movies)) 
          {
            return response()->json("There Are No movies By this Search!");
          }
          return response()->json($movies);
    }

    /**
     *  Show the  Movies sorted by release_year
     * @param mixed $request
     * 
     */
    public function sortMovie( $request )
    {
     
      if($request->ASC == '1')
      {
        $movies = Movie::orderBy('release_year', 'asc')->get(); // For ascending order
        return response()->json([
          "Sort Type:" => "ASC",
          "Movies" =>$movies,
          
        ]);
      }elseif($request->ASC == '0'){
        $movies = Movie::orderBy('release_year', 'desc')->get(); // For descending order
        return response()->json([
           "Sort Type:"  =>"DESC",
          "Movies" =>$movies,
         
        ]);
      }
      
    }

    }

