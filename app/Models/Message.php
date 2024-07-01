<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Message
 *
 * @property int $id
 * @property int|null $chat_id
 * @property string $role
 * @property string $content
 * @property int|null $parent_id
 * @property int $prompt_tokens
 * @property int $completion_tokens
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Chat|null $chat
 * @method static \Database\Factories\MessageFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereChatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereCompletionTokens($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message wherePromptTokens($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Message withoutTrashed()
 * @mixin \Eloquent
 */
class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['role', 'content', 'prompt_tokens', 'completion_tokens'];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'prompt_tokens' => '0',
        'completion_tokens' => '0',
    ];

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }
}
