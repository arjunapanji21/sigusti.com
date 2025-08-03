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
        $conversations = collect();
        
        if ($user->isAdmin()) {
            // Admin sees conversations from users
            $chats = Chat::with(['from_user', 'to_user'])
                ->where('to_user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get()
                ->groupBy('from_user_id');
                
            foreach ($chats as $fromUserId => $chatGroup) {
                $fromUser = User::find($fromUserId);
                if ($fromUser) {
                    $lastMessage = $chatGroup->first();
                    $conversations->push([
                        'user' => $fromUser,
                        'last_message' => $lastMessage ? $lastMessage->message : null,
                        'last_message_time' => $lastMessage ? $lastMessage->created_at : null,
                        'unread_count' => $chatGroup->where('seen', 0)->count(),
                    ]);
                }
            }
        } else {
            // Regular user sees their conversations with admins
            $chats = Chat::with(['from_user', 'to_user'])
                ->where(function($q) use ($user) {
                    $q->where('from_user_id', $user->id)
                      ->orWhere('to_user_id', $user->id);
                })
                ->orderBy('created_at', 'desc')
                ->get();
                
            // Group by the other user (not current user)
            $groupedChats = $chats->groupBy(function($chat) use ($user) {
                return $chat->from_user_id == $user->id ? $chat->to_user_id : $chat->from_user_id;
            });
            
            foreach ($groupedChats as $otherUserId => $chatGroup) {
                $otherUser = User::find($otherUserId);
                if ($otherUser && $otherUser->id != $user->id) {
                    $lastMessage = $chatGroup->first();
                    $conversations->push([
                        'user' => $otherUser,
                        'last_message' => $lastMessage ? $lastMessage->message : null,
                        'last_message_time' => $lastMessage ? $lastMessage->created_at : null,
                        'unread_count' => $chatGroup->where('to_user_id', $user->id)->where('seen', 0)->count(),
                    ]);
                }
            }
        }
        
        // Sort by last message time and paginate
        $conversations = $conversations->sortByDesc('last_message_time');
        
        // Manual pagination for collection
        $perPage = 10;
        $currentPage = request()->get('page', 1);
        $total = $conversations->count();
        $conversations = $conversations->slice(($currentPage - 1) * $perPage, $perPage)->values();
        
        // Create paginator
        $conversations = new \Illuminate\Pagination\LengthAwarePaginator(
            $conversations,
            $total,
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'pageName' => 'page']
        );
        
        return view('chat.index', compact('conversations'));
    }

    public function show($userId)
    {
        $user = auth()->user();
        $chatUser = User::find($userId);
        
        if (!$chatUser) {
            abort(404, 'User not found');
        }
        
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
