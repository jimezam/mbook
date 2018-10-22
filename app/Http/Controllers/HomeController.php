<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $mbooksMine = Mbook::ownedByMe()->latestUpdate()->paginate(10);
        // TODO: notOwnedByMe
        // TODO: tag nuevo
        $mbooksRecent = Mbook::published()->latestUpdate()->paginate(10);

        return view('home', compact('mbooksMine', 'mbooksRecent'));
    }
}
