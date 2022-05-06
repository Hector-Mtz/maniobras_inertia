<?php

namespace App\Http\Controllers;

use App\Models\turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TurnoController extends Controller
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
        //
        $datosTurnos =request()->except('cantidad');
        turno::insert($datosTurnos);


         //DATOS DE MONTO
          $turno = turno::latest('id')->first(); //ordena los ids de forma descendente y toma el primer registro de esa consulta descendente

          $turno_id = $turno['id'];

          $datosMonto = request()->except('maniobras_id','FechaInicio','FechaFinal','HoraInicio','HoraFinal','NumeroManiobristas','rango','nota','0');

          $cantidad=$datosMonto['cantidad'];

          DB::insert('insert into montos (turno_id, cantidad) values (?, ?)',[$turno_id,$cantidad]);

        return  redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\turno  $turno
     * @return \Illuminate\Http\Response
     */
    public function show(turno $turno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\turno  $turno
     * @return \Illuminate\Http\Response
     */
    public function edit(turno $turno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\turno  $turno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, turno $turno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\turno  $turno
     * @return \Illuminate\Http\Response
     */
    public function destroy(turno $turno)
    {
        //
    }
}
