<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use hasFactory;
    protected $fillable = ['id', 'name', 'status'];
}
