<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Mbook;
use App\Msection;
use App\Msheet;

class BookViewerController extends Controller
{
    public function index(Request $request, $code)
    {
        return $this->view($request, $code, null, null);
    }

    public function view(Request $request, $code, $msectionId, $msheetId)
    {
        // Load the mbook from the id/shortname

        $mbook = $this->getBook($code);

        // Check the mbook is published or user on session is the owner

        if($mbook->user_id != Auth::id())
            if($mbook->state != 'published')
                abort(403, "The mbook cannot be viewed if it is not published or the user owns it.");

        // Load the msection/msheet data according with user's input

        $msection = null;
        $msheet = null;

        if($msectionId == null)                                 // Load the first msection of mbook
            $msection = $mbook->msections->first();
        else                                                    // Load the specified msection's id
            $msection = Msection::findOrFail($msectionId);

        if($msheetId == null)
        {
            if($msection != null)                               // Load the first msheet of the msection
                $msheet = $msection->msheets->first();
        }
        else
            $msheet = Msheet::findOrFail($msheetId);            // Load the specified msheet's id

        if($msection == null)
            $msheet = null;

        // Check the msection/msheet really belongs to mbook

        if($msection != null && $msheet != null && !$mbook->checkSheetBelong($msection, $msheet))
            abort(404, "The msection/msheet does not belong to this mbook");

        // Add the themes directory to the sources of views

        view()->addLocation(storage_path('app/themes'));

        // Render the view

        return view('bookviewer.view', compact('code', 'mbook', 'msection', 'msheet'));
    }

    public function metadata(Request $request, $code)
    {
        $mbook = $this->getBook($code);

        return view('bookviewer.metadata', compact('mbook'));
    }

    protected function getBook($code)
    {
        $mbook = null;

        if(is_numeric($code))
            $mbook = Mbook::findOrFail($code);
        else 
            $mbook = Mbook::where('shortname', '=', $code)->firstOrFail();

        return $mbook;
    }
}
