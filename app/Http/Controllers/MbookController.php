<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\MbookCreateRequest;
use App\Category;
use App\Mbook;
use App\Theme;

class MbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mbooks = Mbook::ownedByMe()->orderBy('updated_at', 'desc')->paginate(10);

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
        $themes = Theme::listAvailableThemes();
        $styles = [];

        return view('mbooks.create', compact('categories', 'states', 'themes', 'styles'));
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
            ->with('success', '¡Libro creado exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Mbook $mbook)
    {
        return view('mbooks.show', compact('mbook'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Mbook $mbook)
    {
        $categories = Category::orderby('name', 'asc') -> pluck('name', 'id');
        $states = Mbook::getStates();
        $themes = Theme::listAvailableThemes();
        $styles = [];

        return view('mbooks.edit', compact('mbook', 'categories', 'states', 'themes', 'styles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MbookCreateRequest $request, Mbook $mbook)
    {
        $input = $request->all();

        $mbook->fill($input)->save();

        return redirect()
            ->route('mbooks.index')
            ->with('success', '¡Libro editado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mbook $mbook)
    {
        $mbook->delete();

        return redirect()
            ->route('mbooks.index')
            ->with('success', '¡Libro removido exitosamente!');
    }

    public function bookmark(Request $request, Mbook $mbook)
    {
        $count = $mbook->bookmarkOwners()->where('user_id', '=', Auth::id())->count();

        $control = false;

        if($count == 0)
        {
            $mbook->bookmark(Auth::user());
            $control = true;
        }
        else
        {
            $mbook->bookmark(Auth::user(), false);
            $control = false;
        }
        
        return response()->json([
            'bookmark' => $control
        ], Response::HTTP_OK);
    }
}
