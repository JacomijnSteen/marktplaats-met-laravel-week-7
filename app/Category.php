<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'datum', 'name', 'advertentie_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'datum', 'advertentie_id',
    ];
}
