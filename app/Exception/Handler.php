<?php
namespace App\Exception;


use Throwable;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    

    // public function render($request, Throwable $exception)
    // {
    //     if ($exception instanceof AuthorizationException ) {
    //         return response()->json(['error' => 'This action is unauthorized.'], 403);
    //     }
    
    //     return parent::render($request, $exception);
    // }
    
    
}