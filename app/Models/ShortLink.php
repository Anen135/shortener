<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['user_id', 'original_url', 'short_code', 'clicks_count'])]
class ShortLink extends Model
{
    protected static function booted()
    {
        static::creating(function ($link) {

            if (!$link->short_code) {

                do {
                    $code = \Illuminate\Support\Str::random(6);
                } while (
                    static::where('short_code', $code)->exists()
                );

                $link->short_code = $code;
            }

            $link->user_id = auth()->id();
        });
    }


    public function getShortUrlAttribute(): string
    {
        return url('/s/' . $this->short_code);
    }

    public function visits()
    {
        return $this->hasMany(LinkVisit::class);
    }
}
