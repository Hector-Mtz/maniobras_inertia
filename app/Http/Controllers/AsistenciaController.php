<?php

namespace App\Http\Controllers;

use App\Models\asistencia;
use Illuminate\Http\Request;
use App\Events\turnosactivos;

class AsistenciaController extends Controller
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
        // $user = Auth::user();
        // broadcast(new turnosactivos($user));
        $asistencia = new asistencia(); //Necesitamso guardar el registro que se emitira en una variable

        $asistencia->user_id = $request->user_id; //manda a llamar todos los elementos insetados en la BD

        $asistencia->turno_id = $request->turno_id;

        $asistencia->monto_id = $request->monto_id;

        $asistencia->documento_id = $request->documento_id  ;

        $asistencia->asistencia = $request->asistencia;

        $asistencia->save(); //guarda todos los datos y los envia

        broadcast(new turnosactivos(
        $asistencia->turno_id,
        $asistencia->user->name,
        $asistencia->monto->cantidad )); //transmision de evento

        //$datosAsistencia = request()->except('_token'); //insercion de datos
        //Asistencias::insert($datosAsistencia);
        return  redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function show(asistencia $asistencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function edit(asistencia $asistencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, asistencia $asistencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(asistencia $asistencia)
    {
        //
    }
}
