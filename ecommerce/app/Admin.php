<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactor;
    protected $guarded=['id'];
}
