<?php

namespace App\Http\Controllers\Api\MenageUser;

use App\Helpers\ApiResponseHelpers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    public function getUsers(Request $request)
    {
        try{
            $users = User::select('username', 'personal_number', 'nm_uker', 'jabatan')->get();

            if($request->ajax()){
                return DataTables::of($users)->make();
            }

            return ApiResponseHelpers::successResponseJson('success', 'Berhasil mendapatkan data', $users, 200);

        }catch(Exception $e){
            return ApiResponseHelpers::errorResponseJson('error', 'Error: '. $e->getMessage(), 500);
        }
    }
}
