<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Inertia\Inertia;
use App\Models\Message;
use App\Models\SystemMessage;
use App\Jobs\StoreChatMessage;
use App\Jobs\UpdateChatMessage;
use App\Models\LargeLanguageModel;
use Illuminate\Support\Facades\Log;
use App\Service\Chat as ChatService;
use Illuminate\Support\Facades\Auth;
use Saloon\Exceptions\SaloonException;
use App\Http\Requests\StoreChatRequest;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\UpdateChatRequest;

class ChatController extends Controller
{

    private $conversation = [
        'id' => 'root',
        'content' => 'Start of conversation',
        'children' => [
            [
                'id' => '1',
                'content' => 'Hello, how can I help you today?',
                'children' => [
                    [
                        'id' => '1.1',
                        'content' => 'I need help with my account.',
                        'children' => []
                    ],
                    [
                        'id' => '1.2',
                        'content' => 'I have a question about your services.',
                        'children' => []
                    ]
                ]
            ],
            [
                'id' => '2',
                'content' => 'Welcome back! What would you like to do?',
                'children' => []
            ]
        ]
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = request()->user();
        $chats = Chat::where('user_id', $user->id)->orderBy('id', 'desc')->get();

        return response()->json([
            'chats' => $chats
        ]);
    }

    public function show(Chat $chat)
    {
        $messages = $chat->messages;
        return response()->json([
            'messages' => $messages
        ]);
    }

    public function addNode(Request $request)
    {
        $content = $request->input('content');
        $parentId = $request->input('parentId');

        // In a real application, you would update the conversation in the database
        // For this example, we'll just return a new node
        $newNode = [
            'id' => uniqid(),
            'content' => $content,
            'children' => []
        ];

        return response()->json($newNode);
    }
}
