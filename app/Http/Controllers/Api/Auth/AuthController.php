<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
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
                        'status' => 'fail',
                        'statusCode'=> 402,
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
                return response()->json([
                    'status' => 'fail',
                    'statusCode'=> 402,
                    'message' => 'Personal Number dan password tidak sesuai',
                ]);
            }

            $user = Auth::user();

            $token = JWTAuth::attempt($credential);

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
            return response()->json([
                'status' => 'error',
                'statusCode'=> 500,
                'message' => 'Error: '. $e->getMessage(),
            ]);
        }
    }

    private function guard($credential)
    {
        return Auth::attempt(array('personal_number'=> $credential['personal_number'], 'password'=> $credential['password']));
    }
}
