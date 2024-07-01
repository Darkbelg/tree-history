<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Chat
 *
 * @property int $id
 * @property int $user_id
 * @property string $subject
 * @property string $location
 * @property string $category
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $large_language_model_id
 * @property int|null $system_message_id
 * @property-read \App\Models\LargeLanguageModel $largeLanguageModel
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Message> $messages
 * @property-read int|null $messages_count
 * @property-read \App\Models\SystemMessage|null $systemMessage
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ChatFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Chat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat query()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereLargeLanguageModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereSystemMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereUserId($value)
 * @mixin \Eloquent
 */
class Chat extends Model
{
    use HasFactory;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'location' => 'home',
        'category' => 'main',
    ];

    protected $fillable = ['subject'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class)->whereIn('role', ['user', 'assistant']);
    }
}
