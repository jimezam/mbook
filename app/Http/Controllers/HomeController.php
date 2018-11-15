<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Mbook;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mbooksReading = Mbook::bookmarkedBy(Auth::id())->latestUpdate()->paginate(10);
        $mbooksMine = Mbook::latestUpdate()->paginate(10);
        $mbooksRecent = Mbook::published()->latestUpdate()->paginate(10);

        return view('home', compact('mbooksReading', 'mbooksMine', 'mbooksRecent'));
    }
}
