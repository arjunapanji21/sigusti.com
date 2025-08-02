<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use stdClass;

class ChatController extends Controller
{

    public function getAdmin($wilayah_id)
    {
        return response()->json([
            'success' => true,
            'data'  => User::where('role', 'admin')->where('wilayah_id', $wilayah_id)->get(),
        ], 201);
    }

    public function getCustomer($admin)
    {
        $customer = [];
        $chat = Chat::where('to_user_id', $admin)
            ->orderBy('id', 'DESC')
            ->get()->groupBy('from_user_id');
        foreach ($chat as $key => $row) {
            $user = User::find($key);
            $customer[] = [
                'id' => $user->id,
                'name' => $user->name,
            ];
        }
        return response()->json([
            'success' => true,
            'data'  => $customer,
        ], 201);
    }

    public function send(Request $request)
    {

        $data = $request->validate([
            'from_user_id' => 'required',
            'to_user_id' => 'required',
            'message' => 'required',
        ]);
        $role = User::find($data['from_user_id'])->role;
        if ($role == "admin") {
            $data['isAdmin'] = true;
        }
        Chat::create($data);
        return response()->json([
            'success' => true,
        ], 201);
    }

    public function read($from, $to)
    {
        $result = Chat::where('from_user_id', $from)
            ->where('to_user_id', $to)
            ->orWhere('from_user_id', $to)
            ->where('to_user_id', $from)
            ->orderBy('id', 'DESC')
            ->get();
        return response()->json([
            'success' => true,
            'data' => $result,
        ], 201);
    }
}
