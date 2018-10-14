<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
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
        // TODO
        // VERIFICAR QUE NO PERMITA EDITAR UN LIBRO NO PROPIO DESDE URL
        // IGUAL OTROS VERBOS

        $input = $request->all();

        $section = new Msection();
        $section->fill($input);
        $section->mbook_id = $mbook->id;
        $section->order = $section->getMaxOrder() + 1;
        $section->save();

        return redirect()
            ->route('mbooks.msections.index', $mbook->id)
            ->with('success', '¡Sección creada exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Mbook $mbook, Msection $msection)
    {
        return view('msections.show', compact('mbook', 'msection'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Mbook $mbook, Msection $msection)
    {
        return view('msections.edit', compact('mbook', 'msection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MsectionCreateRequest $request, Mbook $mbook, Msection $msection)
    {
        $input = $request->all();

        $msection->fill($input)->save();

        return redirect()
            ->route('mbooks.msections.index', $mbook)
            ->with('success', '¡Sección editada exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mbook $mbook, Msection $msection)
    {
        $msection->delete();

        Msection::reindex($mbook);

        return redirect()
            ->route('mbooks.msections.index', [$mbook, $msection])
            ->with('success', '¡Sección removida exitosamente!');
    }

    public function moveUp(Mbook $mbook, Msection $msection)
    {
        $msection->moveUp();

        return redirect()->back();
    }

    public function moveDown(Mbook $mbook, Msection $msection)
    {
        $msection->moveDown();

        return redirect()->back();
    }
}
