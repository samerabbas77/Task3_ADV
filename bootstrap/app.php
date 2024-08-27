<?php

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Application;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Laravel\Sanctum\Http\Middleware\CheckAbilities;
use Laravel\Sanctum\Http\Middleware\CheckForAnyAbility;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'users' =>\App\Http\Middleware\UserMiddleware::class,
            'abilities' => CheckAbilities::class,
            'ability' => CheckForAnyAbility::class,
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function(NotFoundHttpException $e,Request $request){
            if($e instanceof ModelNotFoundException)
            {
                return response("This ID Does not Excists!!") ; 
            }else
            {
                return response("This Page Does not Excists!!") ; 
            }         
        });

        $exceptions->render(function(ValidationException $w,Request $request){
            if ($w instanceof ValidationException) 
            {
                return response()->json([
                    'message' => 'The given data was invalid.',
                    'errors' =>  "Validation Error"
                ], 422);
            }
        });

        $exceptions->render(function(AuthenticationException $r,Request $request){
            if ($r instanceof AuthenticationException) 
            {
                return response()->json([
                    'message' => 'Unauthenticated',
                    'errors' =>  "Check your Token"
                ], 422);
            }
        });



        
    })->create();

   
