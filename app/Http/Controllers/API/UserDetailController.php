<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserDetail;
use Carbon\Carbon;

class UserDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $id_user = $request['id'];
        $date_btd = Carbon::parse($request['date_btd']);

        $user_detail = UserDetail::create([
            'id_user' => $id_user,
            'sex' => $request['sex'],
            'est_civ'=> $request['est_civ'],
            'num_childs'=> $request['num_childs'],
            'date_btd' => $date_btd,
            'email'=> $request['email'],
            'email_personal'=> $request['email_personal'],
            'celphone_pri'=> $request['celphone_pri'],
            'celphone_sec'=> $request['celphone_sec'],
            'celphone_job'=> $request['celphone_job'],
            'adress_dni'=> $request['adress_dni'],
            'adress_home'=> $request['adress_home'],
        ]);
        return ['message' => 'USUARIO DETALLE AGREGADO','data'=>$user_detail->id_user];
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
