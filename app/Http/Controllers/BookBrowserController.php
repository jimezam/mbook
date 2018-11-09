<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Mbook;

class BookBrowserController extends Controller
{
    public function index(Request $request, $source = "recents")
    {
        // Get data from query string
        //  - for recents is the category->id (optional)
        //  - for category is the category->id (optional)
        //  - for keywords is the user's keywords

        $data = null;

        if($request->has('data')) {
            $data = $request->query('data');
        }

        // Load the data needed for each $source type of contents

        $books = [];
        $object = null;
        $categories = [];

        if($source == "recents")
        {
            $categories = Category::ordered()->get();
            $books = Mbook::published()->latestUpdate();
            
            if($data != null)
                $books = $books->withCategory($data);

            $books = $books->paginate(10);
        }
        else if($source == "category")
        {
            $categories = Category::ordered()->get();

            if($data == null)
                $object = $categories->first();
            else
                $object = Category::findOrFail($data);

            $books = Mbook::published()->withCategory($object->id)
                        ->orderedByName()->paginate(10);
        }
        else if($source == "keywords") 
        {
        }
        else   
            $source = "error";

        // Show error message on wrong $source

        if($source == "error")
            abort(404);

        // Load the corresponding view to selected $source

        return view('bookbrowser.index-'.$source, 
                    compact('source', 'data', 'object', 'categories', 'books'));
    }

    public function search(Request $request)
    {
        // Query string data is the user's keywords for book search

        $data = null;

        if($request->has('data')) {
            $data = $request->query('data');
        }

        // Check if there is no keywords for search, then show error message

        if($data == null)
            return redirect()
                ->route('bookbrowser.index', 'keywords')
                ->with('failure', 'No se especificaron palabras clave para la búsqueda');

        // If there is keywords then do the search

        // TODO:

        dd($data);
    }
}
