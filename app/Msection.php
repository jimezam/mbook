<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Mbook;

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
        return $this->where('mbook_id', '=', $this->mbook_id)->max('order');
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

    public static function reindex(Mbook $mbook)
    {
        $index = 1;

        $msections = Msection::where('mbook_id', '=', $mbook->id)->orderBy('order', 'asc')->get();

        foreach($msections as $msection)
        {
            $msection->order = $index ++;
            $msection->save();
        }
    }
}
