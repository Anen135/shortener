<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortLink;
use App\Models\LinkVisit;

class RedirectController extends Controller
{
    public function __invoke(string $code)
    {
        $link = ShortLink::where(
            'short_code',
            $code
        )->firstOrFail();

    LinkVisit::create([
            'short_link_id' => $link->id,
            'ip_address' => request()->ip(),
            'visited_at' => now(),
        ]);

        $link->increment('clicks_count');

        return redirect()->away(
            $link->original_url
        );
    }
}
