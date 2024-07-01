<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $user = \App\Models\User::factory()->withPersonalTeam()->create([
            'name' => 'Stijn',
            'email' => 'stijn.sagaert@outlook.com',
        ]);

        $chats = Chat::factory()->count(10)->create([
            'user_id' => $user->id,
            'large_language_model_id' => 0,
        ]);

        foreach ($chats as $chat) {
            $path1 = Message::factory()->create([
                'chat_id' => $chat->id,
                'role' => 'user',
            ]);

            $path2 = Message::factory()->create([
                'chat_id' => $chat->id,
                'role' => 'user',
            ]);

            $path10 = Message::factory()->create([
                'chat_id' => $chat->id,
                'parent_id' => $path1->id,
                'role' => 'assistant',
            ]);

            $path11 = Message::factory()->create([
                'chat_id' => $chat->id,
                'parent_id' => $path1->id,
                'role' => 'assistant',
            ]);

            $path20 = Message::factory()->create([
                'chat_id' => $chat->id,
                'parent_id' => $path2->id,
                'role' => 'assistant',
            ]);

            $path111 = Message::factory()->create([
                'chat_id' => $chat->id,
                'parent_id' => $path11->id,
                'role' => 'user',
            ]);

            Message::factory()->count(3)->create([
                'chat_id' => $chat->id,
                'parent_id' => $path11->id,
                'role' => 'user',
            ]);

            Message::factory()->count(3)->create([
                'chat_id' => $chat->id,
                'parent_id' => $path10->id,
                'role' => 'user',
            ]);

            Message::factory()->count(3)->create([
                'chat_id' => $chat->id,
                'parent_id' => $path20->id,
                'role' => 'user',
            ]);

            Message::factory()->count(3)->create([
                'chat_id' => $chat->id,
                'parent_id' => $path111->id,
                'role' => 'assistant',
            ]);
        }
    }
}
