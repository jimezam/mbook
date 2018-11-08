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
        //  - for category is the category->id
        //  - for keywords is the user's keywords

        $data = null;

        if($request->has('data')) {
            $data = $request->query('data');
        }

        // 

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
            
        }
        else if($source == "keywords")
        {
            
        }
        else   
            $source = "error";



        /*
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
        */

        // Show error message on wrong $source

        if($source == "error")
            abort(404);

        // Load the corresponding view to selected $source

        return view('bookbrowser.index-'.$source, 
                    compact('source', 'data', 'object', 'categories', 'books'));
    }
}
