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

        $mbook = Mbook::loadFrom($code);

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
        // TODO: improve the theme system

        view()->addLocation(storage_path('app/themes'));

        // Update the contents of the msheet for web presentation

        $msheet->contents = str_replace ('[%URL%]', url(''), $msheet->contents);

        // Render the view

        return view('bookviewer.view', compact('code', 'mbook', 'msection', 'msheet'));
    }

    public function metadata(Request $request, $code)
    {
        $mbook = Mbook::loadFrom($code);

        return view('bookviewer.metadata', compact('mbook'));
    }

    public function next (Request $request, $shortname, Msection $msection, Msheet $msheet) 
    {
        $mbook = Mbook::loadFrom($shortname);

        $nextSheet = $msection->msheets()->where('order', '=', $msheet->order + 1)->first();

        // If there is a next msheet inside the same msection
        if($nextSheet != null)
        {
            return redirect()
                ->route('bookviewer.view', [$shortname, $msection, $nextSheet]);
        }

        // There is no next msheet in this msection, check the next msections
        // Consider empty msections to be skipped
        $order = $msection->order;

        do
        {
            $nextSection = $mbook->msections()->where('order', '=', ++$order)->first();

            if($nextSection != null)
            {
                $nextSheet = $nextSection->msheets()->first();

                if($nextSheet != null)
                    return redirect()
                        ->route('bookviewer.view', [$shortname, $nextSection, $nextSheet]);
            }
        } while($nextSection != null);

        // There is no next msheet in this mbook
        return redirect()
                ->route('bookviewer.view', [$shortname, $msection, $msheet])
                ->with('failure', 'No hay más páginas en este libro para avanzar');
    }

    public function previous (Request $request, $shortname, Msection $msection, Msheet $msheet) 
    {
        $mbook = Mbook::loadFrom($shortname);

        $prevSheet = $msection->msheets()->where('order', '=', $msheet->order - 1)->first();

        // If there is a previous msheet inside the same msection
        if($prevSheet != null)
        {
            return redirect()
                ->route('bookviewer.view', [$shortname, $msection, $prevSheet]);
        }

        // There is no previous msheet in this msection, check the previous msections
        // Consider empty msections to be skipped
        $order = $msection->order;

        do
        {
            $prevSection = $mbook->msections()->where('order', '=', --$order)->first();

            if($prevSection != null)
            {
                $prevSheet = $prevSection->msheets('desc')->first();

                if($prevSheet != null)
                    return redirect()
                        ->route('bookviewer.view', [$shortname, $prevSection, $prevSheet]);
            }
        } while($prevSection != null);

        // There is no previous msheet in this mbook
        return redirect()
                ->route('bookviewer.view', [$shortname, $msection, $msheet])
                ->with('failure', 'No hay más páginas en este libro para retroceder');
    }
}
