<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\Fillable;


#[Fillable(['short_link_id', 'ip_address'])]
class LinkVisit extends Model
{
    public function shortLink(): BelongsTo
    {
        return $this->belongsTo(ShortLink::class);
    }
}

