<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    // public $table='categories';
    // public $primaryKey='id';
    // public $incrementing=true;
    // public $keyType='int';
    // public $timestamps=false;

    protected $table = 'categories';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'status'
    ];


}
