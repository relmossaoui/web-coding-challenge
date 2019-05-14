<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Shop extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'distance'
    ];

    /**
     * The users that belong to the shop.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}