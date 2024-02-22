<?php

namespace App\Http\Controllers\Api\MenageUser;

use App\Helpers\ApiResponseHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

class UsersController extends Controller
{
    public function getUser(Request $request)
    {

        // $user = $request->user();
        // return ApiResponseHelpers::successResponseJson('success', 'Berhasil mendapatkan data', $user, 200);
    }
}
