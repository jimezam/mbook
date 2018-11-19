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
        'category_id', 'name', 'shortname', 'description', 'state', 'theme', 'style'
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

    public function bookmark($user, $status=true)
    {
        if($status)
            $this->bookmarkOwners()->attach($user);
        else
            $this->bookmarkOwners()->detach($user);
    }

    public function bookmarkOwners()
    {
      return $this->belongsToMany('App\User');
    }

    public function isBookmarkedBy($user)
    {
        return $this->bookmarkOwners->contains($user);
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
    public function scopeUpdated($query, $days = 30)
    {
        $margin = Carbon::now()->subDays($days);

        return $query->whereDate('updated_at', '>', $margin);
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
    public function scopeBookmarkedBy($query, $user)
    {
        return $query->whereHas('bookmarkOwners', function ($query) use ($user) {
            $query->where('user_id', '=', $user);
        });
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

    public function checkSectionBelong($msection)
    {
        return in_array($msection, $this->msections->all());
    }

    public function checkSheetBelong($msection, $msheet)
    {
        if(!$this->checkSectionBelong($msection))
            return false;

        return in_array($msheet, $msection->msheets->all());
    }

    public function getTinyMCEStructure()
    {
        $structure = [];

        // [
        //     {title: 'TinyMCE', value: 'https://www.tiny.cloud'},
        //     {title: 'TinyMCE resources', menu: [
        //     {title: 'TinyMCE documentation', value: 'https://www.tiny.cloud/docs/'},
        //     {title: 'TinyMCE forum', value: 'https://community.tinymce.com/'}
        // ]]

        foreach ($this->msections as $msection)
        {
            $msheets = [];

            if($msection->msheets->isEmpty())
                continue;

            foreach ($msection->msheets as $msheet)
            {
                $msheets[] = [
                    'title' => $msheet->name,
                    'value' => "[%URL%]/viewer/{$this->shortname}/msections/{$msection->id}/msheets/{$msheet->id}"
                ];
            }

            $structure[] = [
                'title' => $msection->name,
                'menu'  => $msheets
            ];
        }

        return $structure;
    }

    public static function loadFrom($code)
    {
        $mbook = null;

        if(is_numeric($code))
            $mbook = Mbook::findOrFail($code);
        else
            $mbook = Mbook::where('shortname', '=', $code)->firstOrFail();

        return $mbook;
    }
}
