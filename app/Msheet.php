<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;
use App\Msection;

class Msheet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'contents', 'order', 'foreground', 'background', 
    ];

    public function msection()
    {
        return $this->belongsTo('App\Msection');
    }

    public function getMaxOrder()
    {
        return $this->where('msection_id', '=', $this->msection_id)
                    ->max('order');
    }

    /**
     * Scope a query to xxx.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfSection($query, $section_id)
    {
        return $query->where('msection_id', '=', $section_id);
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
    public function scopeOfOrder($query, $section_id, $order)
    {
        return Msheet::ofSection($section_id)->where('order', '=', $order)->first();
    }

    public static function reindex(Msection $msection)
    {
        $index = 1;

        DB::transaction(function() use ($index, $msection)
        {
            $msheets = Msheet::ofSection($msection->id)->ordered()->get();

            foreach($msheets as $msheet)
            {
                $msheet->order = $index ++;
                $msheet->save();
            }
        });
    }

    public function moveUp()
    {
        $msheet = $this;

        $order = $msheet->order;
        $maxOrder = $msheet->getMaxOrder();

        if($order < $maxOrder)
        {
            DB::transaction(function() use ($msheet, $order)
            {
                $nextMsheet = Msheet::ofOrder($this->msection->id, $order + 1);

                $msheet->order += 1;
                $nextMsheet->order -= 1;
    
                $msheet->save();
                $nextMsheet->save();
            });
        }
        else
            return false;

        return true;
    }

    public function moveDown()
    {
        $msheet = $this;

        $order = $msheet->order;
        $minOrder = 1;

        if($order > $minOrder)
        {
            DB::transaction(function() use ($msheet, $order)
            {
                $previousMsheet = Msheet::ofOrder($msheet->msection->id, $order - 1);

                $msheet->order -= 1;
                $previousMsheet->order += 1;
    
                $msheet->save();
                $previousMsheet->save();
            });
        }
        else
            return false;

        return true;
    }

    public static function getDefaultForeground()
    {
        return "#000000";
    }

    public static function getDefaultBackground()
    {
        return "#FFFFFF";
    }
}
