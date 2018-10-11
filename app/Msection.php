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

    public function getMaxOrder()
    {
        return $this->max('order');
    }

    /**
     * Scope a query to xxx.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfBook($query, $book)
    {
        return $query->where('mbook_id', '=', $book);
    }

    /**
     * Scope a query to xxx.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdered($query)
    {
        return $query->orderby('order', 'asc');
    }
}
