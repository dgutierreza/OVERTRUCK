<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AreasRolCreateRequest;
use App\Http\Requests\AreasRolUpdateRequest;
use App\Models\AreaRoles;

class AreasRolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas_roles = AreaRoles::join('areas','areas.id','=','areas_rol.id_area')
        ->select('areas_rol.id','areas.id as id_area','areas_rol.name','areas.name as area','areas_rol.created_at')
        ->get();
        
        return $areas_roles;
    }

    
    public function store(AreasRolCreateRequest $request)
    {
        AreaRoles::create([
            'name' => strtoupper($request['name']),
            'id_area' => $request['area'],
        ]);
        return ['message' => 'AREA ROL AGREGADO'];
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

    
    public function update(AreasRolUpdateRequest $request, $id)
    {
        $area_rol =  AreaRoles::findOrFail($id);
        $area_rol->update([
            'name' => strtoupper($request['name']),
            'id_area' => $request['id_area'],
        ]);
        return ['message' => 'AREA ROL ACTUALIZADO'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area_rol = AreaRoles::findOrFail($id);
        $area_rol->delete();
        return ['message' => 'AREA ROL ELIMINADO'];
    }
}
