<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

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
        return $this->hasMany('App\Msection');
    }

    public static function getStates()
    {
        return ['private' => 'private', 
                'published' => 'published', 
                'inactive' => 'inactive'];
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
}
