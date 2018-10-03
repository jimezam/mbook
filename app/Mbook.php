<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mbook extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'name', 'description', 'state',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function msections()
    {
        return $this->hasMany('App\Msection');
    }
}
