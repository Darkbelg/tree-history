<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Inertia\Inertia;
use App\Models\Message;
use App\Models\SystemMessage;
use App\Jobs\StoreChatMessage;
use App\Jobs\UpdateChatMessage;
use App\Models\LargeLanguageModel;
use Illuminate\Support\Collection;
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
        $messages = $chat->load('messages')->messages;
        $tree = $this->buildTree($messages);

        return Inertia::render('Tree', [
            'messages' => $tree
        ]);
    }

    private function buildTree(Collection $messages): array
    {
        $messageMap = $messages->keyBy('id');

        return $messages->whereNull('parent_id')
            ->map(fn ($message) => $this->createBranch($message, $messageMap))
            ->toArray();
    }

    private function createBranch($node, Collection $messageMap): array
    {
        return [
            'id' => $node->id,
            'content' => $node->content,
            'branches' => $messageMap
                ->where('parent_id', $node->id)
                ->map(fn ($childMessage) => $this->createBranch($childMessage, $messageMap))
                ->values()
                ->toArray()
        ];
    }
}
