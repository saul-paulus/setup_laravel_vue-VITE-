<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\ApiResponseHelpers;
use Exception;
use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiErrorResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwtauth')->except('authLogin');
    }

    public function authLogin(Request $request)
    {
        try{
            // Validation User login
            $credential = $request->validate([
                'personal_number' => 'required|string',
                'password' => 'required'
            ]);

            // Check user login->tbl_user
            $cekUser = User::where('personal_number', $credential['personal_number'])->first();

            if(!$cekUser){
                $pegawai = Pegawai::where('personal_number', $credential['personal_number'])->first();

                if(!$pegawai){
                    return response()->json([
                        'status' => 'error',
                        'statusCode'=> 422,
                        'message' => 'Personal Number dan password tidak sesuai',
                    ]);
                }

                $dataPegawai = [
                    'username' => $pegawai->nama_pegawai,
                    'personal_number' => $pegawai->personal_number,
                    'password' => bcrypt($pegawai->password),
                    'codeuker' => $pegawai->codeuker,
                    'nm_uker' => $pegawai->nama_uker,
                    'jabatan' => $pegawai->jabatan,
                    'remember_token' => null
                ];

                User::create($dataPegawai);
            }

            if(!$this->guard($credential)){
                return ApiResponseHelpers::errorResponseJson('error', 'Personal Number and Password invalid', 422);
            }

            $user = Auth::user();

            $token = JWTAuth::attempt($credential);

            User::where('personal_number', $user->personal_number)->update([
                'remember_token' => $token
            ]);

            if($user){
                return response()->json([
                    'status' => 'success',
                    'statusCode'=> 200,
                    'message' => 'Berhasil Login',
                    'data' => $user,
                    'token' => $token,
                    'token_type' => 'Bearer'
                ]);
            }
        }catch(Exception $e){
            return ApiResponseHelpers::errorResponseJson('error', 'Error: '.$e->getMessage(), 500);
        }
    }

    private function guard($credential)
    {
        return Auth::attempt(array('personal_number'=> $credential['personal_number'], 'password'=> $credential['password']));
    }


    public function authLogout()
    {
        JWTAuth::invalidate();

        return ApiResponseHelpers::successResponseJson('success', 'Logged out Successfully',[], 200);
    }

    public function checkToken(Request $request)
    {
        $token = $request->input('access_token');

        $user = Auth::user();

        if($user->remember_token == $token){
            return ApiResponseHelpers::successResponseJson('success', 'Token Sesuai',[], 200);
        }else{
            return ApiResponseHelpers::errorResponseJson('error', 'Token Tidak Sesuai',422);
        }
    }

    public function getUser(Request $request)
    {
        $user = $request->user();

        return ApiResponseHelpers::successResponseJson('success', 'Berhasil mendapatkan data user', $user, 200);
    }
}
