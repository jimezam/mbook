<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;
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
    public function scopeOfBook($query, $book_id)
    {
        return $query->where('mbook_id', '=', $book_id);
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

    /**
     * Scope a query to xxx.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfOrder($query, $book_id, $order)
    {
        return Msection::ofBook($book_id)->where('order', '=', $order)->first();
    }

    public static function reindex(Mbook $mbook)
    {
        $index = 1;

        DB::transaction(function() use ($index, $mbook)
        {
            $msections = Msection::ofBook($mbook->id)->ordered()->get();

            foreach($msections as $msection)
            {
                $msection->order = $index ++;
                $msection->save();
            }
        });
    }

    public function moveUp()
    {
        $msection = $this;

        $order = $msection->order;
        $maxOrder = $msection->getMaxOrder();

        if($order < $maxOrder)
        {
            DB::transaction(function() use ($msection, $order)
            {
                $nextMsection = Msection::ofOrder($this->mbook->id, $order + 1);

                $msection->order += 1;
                $nextMsection->order -= 1;
    
                $msection->save();
                $nextMsection->save();
            });
        }
        else
            return false;

        return true;
    }

    public function moveDown()
    {
        $msection = $this;

        $order = $msection->order;
        $minOrder = 1;

        if($order > $minOrder)
        {
            DB::transaction(function() use ($msection, $order)
            {
                $previousMsection = Msection::ofOrder($msection->mbook->id, $order - 1);

                $msection->order -= 1;
                $previousMsection->order += 1;
    
                $msection->save();
                $previousMsection->save();
            });
        }
        else
            return false;

        return true;
    }
}
