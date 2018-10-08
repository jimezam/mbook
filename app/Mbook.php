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
        'category_id', 'name', 'shortname', 'description', 'state',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function msections()
    {
        return $this->hasMany('App\Msection');
    }

    public static function getStates()
    {
        return ['private' => 'private', 
                'published' => 'published', 
                'inactive' => 'inactive'];
    }
}
