<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Diary extends Model
{
    use SoftDeletes;
    /**
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'diary_number',
        'content',
        'image_path',
    ];

    // URLのパラメータとして diary_number を使用する
    public function getRouteKeyName(): string
    {
        return 'diary_number';
    }

    // diary_number はログインユーザーのスコープで解決する
    public function resolveRouteBinding($value, $field = null): static
    {
        return $this->where('diary_number', $value)
            ->where('user_id', auth()->id())
            ->firstOrFail();
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function imagePublicUrl(): ?string
    {
        if ($this->image_path === null || $this->image_path === '') {
            return null;
        }

        return Storage::disk('public')->url($this->image_path);
    }
}
