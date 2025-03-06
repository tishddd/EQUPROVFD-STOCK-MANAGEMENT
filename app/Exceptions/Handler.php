<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception)
    {
        // Force JSON response for all API requests
        if ($request->expectsJson() || $request->is('api/*')) {
    
            // Handle JWT Authentication Errors
            if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['error' => 'Token has expired'], 401);
            }
    
            if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['error' => 'Token is invalid'], 401);
            }
    
            if ($exception instanceof \Tymon\JWTAuth\Exceptions\JWTException) {
                return response()->json(['error' => 'Token not provided'], 401);
            }
    
            // Handle Laravel Authentication Errors
            if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
    
            // Handle Access Denied Errors
            if ($exception instanceof \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException) {
                return response()->json(['error' => 'Forbidden'], 403);
            }
    
            // Handle General HTTP Exceptions
            if ($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
                return response()->json(['error' => $exception->getMessage()], $exception->getStatusCode());
            }
    
            // Handle All Other Exceptions as JSON
            return response()->json([
                'error' => 'Something went wrong',
                'message' => $exception->getMessage(),
            ], 500);
        }
    
        return parent::render($request, $exception);
    }
    
}
