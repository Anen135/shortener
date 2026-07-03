<?php

namespace App\Services;

use App\Models\ShortLink;
use Illuminate\Support\Str;

class ShortCodeGenerator
{
    public function generate(): string
    {
        do {
            $code = Str::random(6);
        } while (
            ShortLink::where('short_code', $code)->exists()
        );

        return '/s/' . $code;
    }
}
