<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertentie extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'created_at', 'image', 'titel', 'omschrijving', 'naamVerkoper', 'vraagprijs', 'category',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'created_at',
    ];
}
