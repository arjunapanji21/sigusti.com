<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Twilio\Rest\Client;


class UserController extends Controller
{
    private function requestOTP(string $recipient)
    {
        $otp = rand(1000, 9999);
        $twilio_whatsapp_number = getenv("TWILIO_WHATSAPP_NUMBER");
        $account_sid = getenv("TWILIO_ACCOUNT_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");

        $client = new Client($account_sid, $auth_token);
        $message = "Kode OTP Anda $otp";
        return $client->messages->create("whatsapp:$recipient", array('from' => "whatsapp:$twilio_whatsapp_number", 'body' => $message));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            // 'email' => 'required',
            // 'password' => 'required',
            'telp' => 'required',
            'password' => 'required',
        ]);

        $token = auth()->guard('api')->attempt($credentials);

        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'No. telp atau password salah'
            ], 401);
        }

        //if auth success
        return response()->json([
            'success' => true,
            'user'    => auth()->guard('api')->user(),
            'token'   => $token
        ], 200);
    }

    public function logout(Request $request)
    {
        //remove token
        $removeToken = JWTAuth::invalidate(JWTAuth::getToken());

        if ($removeToken) {
            //return response JSON
            return response()->json([
                'success' => true,
                'message' => 'Logout berhasil!',
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return [
            "status" => 1,
            "data" => $users,
        ];
    }

    private function sendWhatsappNotification(string $otp, string $recipient)
    {
        $twilio_whatsapp_number = getenv("TWILIO_WHATSAPP_NUMBER");
        $account_sid = getenv("TWILIO_ACCOUNT_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");

        $client = new Client($account_sid, $auth_token);
        $message = "Kode OTP Anda $otp";
        return $client->messages->create("whatsapp:$recipient", array('from' => "whatsapp:$twilio_whatsapp_number", 'body' => $message));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'tgl_lahir' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
            'wilayah_id' => 'required',
            'telp' => 'required|unique:users',
            // 'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $data['name'] = ucwords($data['name']);
        $data['password'] = bcrypt($data['password']);

        // $otp = rand(1000, 9999);
        // $data['otp'] = $otp;

        $user = User::create($data);

        if ($user) {
            // $this->sendWhatsappNotification($otp, $user->telp);
            return response()->json([
                'success' => true,
                'user'    => $user,
            ], 201);
        }

        //return JSON process insert failed 
        return response()->json([
            'success' => false,
        ], 409);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return [
            "status" => 1,
            "data" => $user
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'tgl_lahir' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
            'wilayah' => 'required',
            'telp' => 'required',
            // 'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user->update($request->all());

        return [
            "status" => 1,
            "data" => $user,
            "msg" => "User updated successfully"
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return [
            "status" => 1,
            "data" => $user,
            "msg" => "User deleted successfully"
        ];
    }
}
