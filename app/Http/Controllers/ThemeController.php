<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Theme;

class ThemeController extends Controller
{
    public function getStyles($theme)
    {
        return json_encode(Theme::listAvailableStyles($theme));
    }
}
