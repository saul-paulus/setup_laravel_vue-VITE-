<?php

namespace App\Http\Middleware;

use App\Helpers\ApiResponseHelpers;
use App\Http\Responses\ApiErrorResponse;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try{
            $user = JWTAuth::parseToken()->authenticate();

            if(!$user){
                return ApiResponseHelpers::errorResponseJson('error', 'Jwt tidak dapat digenerate token', 500);
            }

        }catch(Exception $e){

            if($e instanceof TokenExpiredException){
                $newToken = JWTAuth::parseToken()->refresh();
                return response()->json(['success' => false, 'token' => $newToken, 'status' => 'Expired'], 200);
            }else if($e instanceof TokenInvalidException){
                return ApiResponseHelpers::errorResponseJson('error', 'Token Invalid', 401);
            }else{
                return ApiResponseHelpers::errorResponseJson('error', 'Token Not Found', 401);
            }
        }
        return $next($request);
    }
}
