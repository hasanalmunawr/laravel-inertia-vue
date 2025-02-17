<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public static function booted()
    {
        static::creating(function (Question $question) {
            $baseSlug = Str::slug($question->title);
            $slug = $baseSlug;
            $count = 1;

            // Cek apakah slug sudah ada dalam database
            while (Question::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $count;
                $count++;
            }

            $question->slug = $slug;
        });
    }

    public function scopeMine(Builder $builder): Builder
    {
        return auth() ? $builder->whereBelongsTo(auth()->user()) : $builder;
    }

    public function scopeUnanswered(Builder $builder): Builder
    {
        return $builder->where('answers_count', "=", 0);
    }

    public function scopeScored(Builder $builder): Builder
    {
        return $builder->orderBy('votes_count', 'desc');
    }
}
