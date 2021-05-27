<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\User;
use App\Models\UserDetail;
use DB;

class UserController extends Controller
{
    public function search_dni($dni){
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $consulta = file_get_contents('https://dniruc.apisperu.com/api/v1/dni/'.$dni.'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImRpZWdvLmd1dGllcnJ6MTVAZ21haWwuY29tIn0.s56WARRuiTk-1QrKtWUmox6kgC346C0OT_QkIGzwxvs',false,stream_context_create($arrContextOptions));
        return response($consulta)->header('Content-Type', 'application/json');
    }

    public function index()
    {
        return User::select('users.id','users.dni',
        DB::raw("CONCAT(users.first_name, ' ', users.second_name,' ',users.first_last_name,' ',users.second_last_name) as name_complete"),'users.created_at')
        ->latest()
        ->take(10)
        ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $first_name = $request['first_name'];
        $second_name = $request['second_name'];
        $first_last_name = $request['first_last_name'];
        $second_last_name = $request['second_last_name'];
         User::create([
            'dni' => $request['dni'],
            'first_name' => $first_name,
            'second_name' => empty($second_name) ? '':$second_name,
            'first_last_name' => $first_last_name,
            'second_last_name' => $second_last_name,
            'password' => $request['dni'],
        ]);
        return ['message' => 'USUARIO AGREGADO'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::select('users.id','users.dni',
        DB::raw("CONCAT(users.first_name, ' ', users.second_name,' ',users.first_last_name,' ',users.second_last_name) as name_complete"),'users.created_at')
        ->where('users.id',$id)
        ->whereNull('users.deleted_at')
        ->get();

        $pre_user_detail = UserDetail::where('users_detail.id_user', '=', $id)->get();
        /*if($pre_user_detail->isEmpty()){
            UserDetail::create([
                'id_user' => $id,
            ]);
        }
        $user_detail = UserDetail::where('users_detail.id_user', '=', $id)->get();*/

        $user_detail = $pre_user_detail->isEmpty() ? null:$pre_user_detail;
        return ['user'=> $user,'user_detail'=>$user_detail];
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

    public function select_sexs()
    {
        $data = array(['id' => null,'name' => 'Seleccione una Opción'],['id' =>'M','name' => 'Masculino'],['id' =>'F','name' => 'Femenino']);     
        return response()->json(['sexs'=>$data]); 
    }
    public function select_civil_status()
    {
        $data = array(['id' => null,'name' => 'Seleccione una Opción'],['id' =>'S','name' => 'Soltero'],['id' =>'C','name' => 'Casado'],
        ['id' =>'D','name' => 'Divorciado'],['id' =>'V','name' => 'Viudo']);     
        return response()->json(['status'=>$data]); 
    }
}
