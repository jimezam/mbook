<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        // TODO: verify the book IS published

        // TODO: si son NULL -> primeros, si no existen ...

        $mbook = $this->getBook($code);
        $msection = null;
        $msheet = null;

        if($msectionId == null)
            $msection = $mbook->msections->first();
        else
            $msection = Msection::findOrFail($msectionId);

        if($msheetId == null)
        {
            if($msection != null)
                $msheet = $msection->msheets->first();
        }
        else
            $msheet = Msheet::findOrFail($msheetId);

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
