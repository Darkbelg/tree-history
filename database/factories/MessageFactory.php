<?php

namespace Database\Factories;

use App\Models\Chat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $words = random_int(50, 1024);
        $content = fake()->words($words, true);

        return [
            'chat_id' => Chat::factory(),
            'role' => collect(['system', 'user', 'assistant'])->random(),
            'content' => $content,
            'parent_id' => null,
            'prompt_tokens' => random_int(10, 2056),
            'completion_tokens' => ceil($words * 0.75),
        ];
    }
}
