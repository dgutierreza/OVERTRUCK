<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AreaCreateRequest;
use App\Http\Requests\AreaUpdateRequest;
use App\Models\Areas;

class AreasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Areas::all();
        
        return $areas;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaCreateRequest $request)
    {
        Areas::create([
            'name' => strtoupper($request['name']),
            'acronym' => strtoupper($request['acronym']),
        ]);
        return ['message' => 'AREA AGREGADA'];
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
    public function update(AreaUpdateRequest $request, $id)
    {
        $area = Areas::findOrFail($id);
        $area->update([
            'name' => strtoupper($request['name']),
            'acronym' => strtoupper($request['acronym']),
        ]);
        return ['message' => 'AREA ACTUALIZADA'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = Areas::findOrFail($id);
        $area->delete();
        return ['message' => 'Area Eliminada'];
    }

    public function select_areas()
    {
        $inicio = array(['id' => null,'name' => 'Seleccione una Opción']);
        $areas = Areas::all();
        $total = array_collapse([$inicio,$areas]);     
        return response()->json(['areas'=>$total]); 
    }
}
