<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function msections()
    {
        return $this->hasMany('App\Msection')->ordered();
    }

    public static function getStates()
    {
        return ['private' => 'private', 
                'published' => 'published', 
                'inactive' => 'inactive'];
    }

    public function isNew($days = 30)
    {
        $creation = $this->created_at;
        $now = Carbon::now();

        $diff = $creation->diffInDays($now);

        return $diff <= $days;
    }

    public function isUpdated($days = 30)
    {
        $updated = $this->updated_at;
        $now = Carbon::now();

        $diff = $updated->diffInDays($now);

        return $diff <= $days;
    }
    
    /**
     * Scope a query to xxx.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOwnedBy($query, $user)
    {
        return $query->where('user_id', '=', $user);
    }

    /**
     * Scope a query to xxx.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOwnedByMe($query)
    {
        return $query->where('user_id', '=', Auth::id());
    }

    /**
     * Scope a query to xxx.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotOwnedByMe($query)
    {
        return $query->where('user_id', '<>', Auth::id());
    }

    /**
     * Scope a query to xxx.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLatestCreate($query)
    {
        return $query->orderby('created_at', 'desc');
    }

    /**
     * Scope a query to xxx.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderedByName($query)
    {
        return $query->orderby('name', 'asc');
    }

    /**
     * Scope a query to xxx.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLatestUpdate($query)
    {
        return $query->orderby('updated_at', 'desc');
    }

    /**
     * Scope a query to xxx.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('state', '=', 'published');
    }

    /**
     * Scope a query to xxx.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithCategory($query, $id)
    {
        return $query->where('category_id', '=', $id);
    }
}
