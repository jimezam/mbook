<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\MsheetCreateRequest;
use App\Mbook;
use App\Msection;
use App\Msheet;


class MsheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Mbook $mbook, Msection $msection)
    {
        $msheets = Msheet::ofSection($msection->id)->ordered()->paginate(20);

        return view('msheets.index', compact('mbook', 'msection', 'msheets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Mbook $mbook, Msection $msection)
    {
        return view('msheets.create', compact('mbook', 'msection'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MsheetCreateRequest $request, Mbook $mbook, Msection $msection)
    {
        // TODO
        // VERIFICAR QUE NO PERMITA EDITAR UNA PÁGINA NO PROPIO DESDE URL
        // IGUAL OTROS VERBOS

        $input = $request->all();

        $sheet = new Msheet();
        $sheet->fill($input);
        $sheet->msection_id = $msection->id;
        $sheet->order = $sheet->getMaxOrder() + 1;
        $sheet->save();

        return redirect()
            ->route('mbooks.msections.msheets.index', [$mbook, $msection])
            ->with('success', '¡Página creada exitosamente!');
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
    public function destroy(Mbook $mbook, Msection $msection, Msheet $msheet)
    {
        $msheet->delete();

        Msheet::reindex($msection);

        return redirect()
            ->route('mbooks.msections.msheets.index', [$mbook, $msection])
            ->with('success', 'Página removida exitosamente!');
    }

    public function moveUp(Mbook $mbook, Msection $msection, Msheet $msheet)
    {
        $msheet->moveUp();

        return redirect()->back();
    }

    public function moveDown(Mbook $mbook, Msection $msection, Msheet $msheet)
    {
        $msheet->moveDown();

        return redirect()->back();
    }
}
