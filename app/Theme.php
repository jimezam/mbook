<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;

class Theme extends Model
{
    public static function listAvailableThemes()
    {
        // Based on storage/app
        $themes = Storage::disk('local')->directories('themes');  

        return collect($themes)->map(function ($name) {
            return basename($name);
        });
    }

    public static function listAvailableStyles($theme)
    {
        // Based on storage/app
        $styles = Storage::disk('local')->directories('themes/'.$theme.'/styles');  

        return collect($styles)->map(function ($name) {
            return basename($name);
        });
    }

    public static function path($theme, $file)
    {
        return Storage::disk('local')->url("themes/$theme/$file");
    }
}
