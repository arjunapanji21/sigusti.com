<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{

    public function getAdmin($wilayah_id)
    {
        return response()->json([
            'success' => true,
            'data'  => User::where('is_admin', true)->where('wilayah_id', $wilayah_id)->get(),
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
            if ($user) {
                $customer[] = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'last_message' => $row->first()->message,
                    'last_message_time' => $row->first()->created_at,
                    'unread_count' => $chat->where('seen', 0)->where('from_user_id', $key)->count(),
                ];
            }
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
        $user = User::find($data['from_user_id']);
        if ($user && $user->is_admin) {
            $data['isAdmin'] = true;
        }
        Chat::create($data);
        
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
            ], 201);
        }
        
        return redirect()->back()->with('success', 'Pesan berhasil dikirim');
    }

    public function read($from, $to)
    {
        $result = Chat::where('from_user_id', $from)
            ->where('to_user_id', $to)
            ->orWhere('from_user_id', $to)
            ->where('to_user_id', $from)
            ->orderBy('id', 'ASC')
            ->get();
        return response()->json([
            'success' => true,
            'data' => $result,
        ], 201);
    }

    // Web interface methods
    public function index()
    {
        $user = auth()->user();
        
        if ($user->is_admin) {
            // Get users who have sent messages to this admin
            $conversations = Chat::where('to_user_id', $user->id)
                ->with(['from_user'])
                ->latest()
                ->get()
                ->groupBy('from_user_id')
                ->map(function ($messages) {
                    $lastMessage = $messages->first();
                    return [
                        'user' => $lastMessage->from_user,
                        'last_message' => $lastMessage->message,
                        'last_message_time' => $lastMessage->created_at,
                        'unread_count' => $messages->where('seen', 0)->count(),
                    ];
                });
        } else {
            // Get admins this user can chat with
            $conversations = User::where('is_admin', true)
                ->where('wilayah_id', $user->wilayah_id)
                ->get()
                ->map(function ($admin) use ($user) {
                    $lastMessage = Chat::where(function ($q) use ($user, $admin) {
                        $q->where('from_user_id', $user->id)->where('to_user_id', $admin->id);
                    })->orWhere(function ($q) use ($user, $admin) {
                        $q->where('from_user_id', $admin->id)->where('to_user_id', $user->id);
                    })->latest()->first();
                    
                    return [
                        'user' => $admin,
                        'last_message' => $lastMessage ? $lastMessage->message : null,
                        'last_message_time' => $lastMessage ? $lastMessage->created_at : null,
                        'unread_count' => Chat::where('from_user_id', $admin->id)
                            ->where('to_user_id', $user->id)
                            ->where('seen', 0)
                            ->count(),
                    ];
                });
        }
        
        return view('chat.index', compact('conversations'));
    }

    public function show($userId)
    {
        $user = auth()->user();
        $chatUser = User::findOrFail($userId);
        
        // Get messages between current user and chat user
        $messages = Chat::where(function ($q) use ($user, $userId) {
            $q->where('from_user_id', $user->id)->where('to_user_id', $userId);
        })->orWhere(function ($q) use ($user, $userId) {
            $q->where('from_user_id', $userId)->where('to_user_id', $user->id);
        })->orderBy('created_at', 'asc')->get();
        
        // Mark messages as seen
        Chat::where('from_user_id', $userId)
            ->where('to_user_id', $user->id)
            ->where('seen', 0)
            ->update(['seen' => 1]);
        
        return view('chat.show', compact('chatUser', 'messages'));
    }

    public function markAsRead($messageId)
    {
        $message = Chat::findOrFail($messageId);
        
        if ($message->to_user_id == auth()->id()) {
            $message->update(['seen' => 1]);
        }
        
        return response()->json(['success' => true]);
    }
}
