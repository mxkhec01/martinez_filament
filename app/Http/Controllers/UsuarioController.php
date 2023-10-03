<?php

namespace App\Http\Controllers;

use App\Models\Operador;
use App\Models\Viaje;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UsuarioController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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



    public function login(Request $request) {
        $fields = $request->validate([
            'app_usr' => 'required|string',
            'app_pass' => 'required|string'

        ]);
        $user = Operador::where('usuario',$fields['app_usr'])->first();

        //dd(bcrypt($fields['app_pass']));
        if($user){
        Log::info('Revisando el login del usuario: '.$user->id);
        }else{
            Log::info('Usuario inexistente:'.$fields['app_usr']);
        }

        Log::info('Username: '.$fields['app_usr']);
        Log::info('Pass: '.$fields['app_pass']);
        Log::info('Pass enc: '.md5($fields['app_pass']));

        if(!$user ||  md5($fields['app_pass']) != $user->password ) {
            //
            Log::info('No logra entrar el suaurio...');
            return response ([
                'message' => 'Credenciales incorrectas'
            ], 401);
        }

        Log::info('Usuario entra sin problema');

        $token = $user->createToken('tortonToken')->plainTextToken;

        $response = [
            'operador' => $user,
            'token'     => $token
        ];
        return response($response,201);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
    }


    public function obten_viajes($id) {
        $viajes =  Viaje::with(['entregas','entregas.facturas','entregas.cliente','unidad','anticipos'])->where('operador_id',$id)->where('estado','activo')->get();
        Log::info('Revisando viajes del usuario: '.$id);
        if ($viajes->count() > 0) {
            $response = $viajes->toJson(JSON_PRETTY_PRINT) ;
            Log::info('Viaje del usuario: '.$id. ' tamaño de respuesta: '.strlen($response));
            return response($response,200);

        }

        return response ([
            'message' => 'No hay viajes asignados'
        ], 404);
  }

  public function viajes_semanas()
  {

      $operador = auth()->user();

      Log::info('Revisando viajes semana del usuario: '.$operador->id);


      $viajes_semana = $operador->viajes()->where('fecha_fin','>=',Carbon::now()->subDays(21))
      ->where('estado','finalizado')
      ->select([\DB::raw("IFNULL(SUM(monto_pagado),0) as monto"), \DB::raw("count(1) as num_viajes"), \DB::raw("(fecha_fin - INTERVAL (WEEKDAY(fecha_fin)+1) DAY) inicia, (fecha_fin - INTERVAL (WEEKDAY(fecha_fin)+1) DAY) + INTERVAL(6) DAY fin")])
      ->groupBy(\DB::raw("(fecha_fin - INTERVAL (WEEKDAY(fecha_fin)+1) DAY), (fecha_fin - INTERVAL (WEEKDAY(fecha_fin)+1) DAY) + INTERVAL(6) DAY"))
      ->get();

      $viajes_detalle = $operador->viajes()->where('fecha_fin','>=',Carbon::now()->subDays(21))
      ->where('estado','finalizado')
      ->select(['id','destino',\DB::raw('ifnull(monto_pagado,0)as monto_pagado'),\DB::raw('(fecha_fin - INTERVAL (WEEKDAY(fecha_fin)+1) DAY) inicia')])
      ->get();

        //dd($viajes_detalle);

      if ($viajes_semana->count() > 0) {

          $respuesta = response()->json(['viaje' => $viajes_semana, 'detalle' => $viajes_detalle]);
          Log::info('viajes semana: '.$operador->id.' Tamaño respuesta: '. strlen($respuesta));

          return $respuesta;


        //$response = [ 'viaje' => $viajes_semana->toJson(JSON_PRETTY_PRINT), 'detalle' => $viajes_detalle->toJson(JSON_PRETTY_PRINT)];
        //return response($response,200);
      }

      return response()->json([ 'message'=>'Sin viajes encontrados']);

  }

  public function viajes_recientes()
  {
      $operador = auth()->user();
      Log::info('Revisando viajes recientes del usuario: '.$operador->id);

      $viajes_recientes = $operador->viajes()->where('fecha_fin','>=',Carbon::now()->subDays(21))
          ->select(['id'])
          ->get();

      $response = $viajes_recientes->toJson(JSON_PRETTY_PRINT) ;

      Log::info('Viaje recientes: '.$operador->id. 'tamaño de respuesta: '.strlen($response));

      return $response;
  }

}
