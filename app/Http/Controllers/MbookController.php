<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MbookCreateRequest;
use App\Category;
use App\Mbook;

class MbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mbooks = Mbook::ownedByMe()->orderBy('created_at', 'desc')->paginate(10);

        // Mejorar con https://www.datatables.net/
        // https://github.com/yajra/laravel-datatables
        // https://yajrabox.com/docs/laravel-datatables/7.0

        return view('mbooks.index', compact('mbooks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderby('name', 'asc') -> pluck('name', 'id');
        $states = Mbook::getStates();

        return view('mbooks.create', compact('categories', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MbookCreateRequest $request)
    {
        $input = $request->all();

        // Mbook::create($input);

        $book = new Mbook();
        $book->fill($input);
        $book->user_id = Auth::id();
        $book->save();

        return redirect()
            ->route('mbooks.index')
            ->with('success', 'Book created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
