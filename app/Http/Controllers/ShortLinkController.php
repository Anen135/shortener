<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShortLinkController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'original_url' => ['required', 'url'],
        ]);

        return ShortLink::create([
            'user_id' => auth()->id(),
            'original_url' => $data['original_url'],
            'short_code' => app(ShortCodeGenerator::class)->generate(),
        ]);
    }
}
