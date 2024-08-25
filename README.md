# Movie Library Management API

This is a RESTful API for managing a movie library built using Laravel. The API supports basic CRUD operations (Create, Read, Update, Delete) for movies, adhering to RESTful API design best practices. The API also includes features like data validation, exception handling, pagination, and filtering.

## Features

- **CRUD Operations**: Create, Read, Update, Delete movies in the library.
- **Validation**: Ensures that all inputs are validated before processing.
- **Exception Handling**: Handles exceptions gracefully, providing meaningful error messages.
- **Pagination**: Supports pagination for movie listings to handle large datasets efficiently.
- **Filtering**: Allows filtering movies based on specific criteria (e.g., genre, release year).
- **Sorting**: Supports sorting movies by different attributes (e.g., title, rating).

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP >= 8.1
- Composer
- MySQL or any other supported database
- Laravel 10.x

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/your-username/movie-library-api.git
   cd movie-library-api
   ```

2. Install the dependencies:

   ```bash
   composer install
   ```

3. Copy the `.env.example` file to `.env` and configure your database and other environment settings:

   ```bash
   cp .env.example .env
   ```

4. Generate an application key:

   ```bash
   php artisan key:generate
   ```

5. Run the database migrations to create the necessary tables:

   ```bash
   php artisan migrate
   ```

6. (Optional) Seed the database with sample data:

   ```bash
   php artisan db:seed
   ```

7. Start the development server:

   ```bash
   php artisan serve
   ```

## API Endpoints

Here are the main endpoints available in this API:

### Movies

- **List Movies**: `GET /api/movies`
  - Supports pagination, filtering, and sorting.
- **Get Movie Details**: `GET /api/movies/{id}`
  - Fetches the details of a single movie by its ID.
- **Create Movie**: `POST /api/movies`
  - Requires title, genre, release_year, and rating in the request body.
- **Update Movie**: `PUT /api/movies/{id}`
  - Updates an existing movie’s details.
- **Delete Movie**: `DELETE /api/movies/{id}`
  - Deletes a movie by its ID.

## Documentation on Postman

https://documenter.getpostman.com/view/34411360/2sAXjF9arS
