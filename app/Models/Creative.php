<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Creative extends Model
{
    protected $fillable = ['creative_name', 'height', 'width', 'main_asset', 'logo_asset', 'cta', 'cta_link', 'cta_position'];
}
