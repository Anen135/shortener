<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['short_link_id', 'ip_address'])]
class LinkVisit extends Model
{
    //
}

