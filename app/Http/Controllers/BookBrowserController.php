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
        //  - for category is the category->id
        //  - for recents is null
        //  - for keywords is the user's keywords

        $data = null;

        if($request->has('data')) {
            $data = $request->query('data');
        }

        // Process the request according the $source
        // that can be: category, recents, keywords

        $books = [];

        $object = null;

        $categories = Category::ordered()->get();

        // Browse by recent books

        if($source == "recents")
            $books = Mbook::published()->latestUpdate()->paginate(10);

        // Browse by category
        
        if($source == "category")
        {
            $object = Category::findOrFail($data);
            $books = Mbook::published()->withCategory($data)->orderedByName()->paginate(10);
        }

        // Browse by keywords
        
        if($source == "keywords")
            $books = [];        // TODO: 

        return view('bookbrowser.index', 
                    compact('source', 'data', 'object', 'categories', 'books'));
    }
}
