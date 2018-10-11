<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MsectionCreateRequest;
use App\Mbook;
use App\Msection;

class MsectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Mbook $mbook)
    {
        $msections = Msection::ofBook($mbook->id)->ordered()->paginate(10);

        return view('msections.index', compact('mbook', 'msections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Mbook $mbook)
    {
        return view('msections.create', compact('mbook'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MsectionCreateRequest $request, Mbook $mbook)
    {
        // VERIFICAR QUE NO PERMITA EDITAR UN LIBRO NO PROPIO DESDE URL
        // VERIFICAR QUE EL GETMAXORDER NO INTEFIERA ENTRE MSECTIONS DE MBOOKS

        $input = $request->all();

        $section = new Msection();
        $section->fill($input);
        $section->mbook_id = $mbook->id;
        $section->order = $section->getMaxOrder() + 1;
        $section->save();

        return redirect()
            ->route('mbooks.msections.index', $mbook->id)
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
        /*
        return view('mbooks.show', compact('mbook'));
        */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Mbook $mbook)
    {
        /*
        $categories = Category::orderby('name', 'asc') -> pluck('name', 'id');
        $states = Mbook::getStates();

        return view('mbooks.edit', compact('mbook', 'categories', 'states'));
        */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mbook $mbook)
    {
        /*
        $input = $request->all();

        $mbook->fill($input)->save();

        return redirect()
            ->route('mbooks.index')
            ->with('success', '¡Libro editado exitosamente!');
        */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mbook $mbook)
    {
        /*
        $mbook->delete();

        return redirect()
            ->route('mbooks.index')
            ->with('success', '¡Libro removido exitosamente!');
        */
    }
}
