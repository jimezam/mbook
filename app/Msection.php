<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Msection extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'order',
    ];

    public function mbook()
    {
        return $this->belongsTo('App\Mbook');
    }

    public function msheets()
    {
        return $this->hasMany('App\Msheet');
    }
}
