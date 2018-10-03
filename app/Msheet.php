<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Msheet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contents', 'order', 'foreground', 'background', 
    ];

    public function msection()
    {
        return $this->belongsTo('App\Msection');
    }
}
