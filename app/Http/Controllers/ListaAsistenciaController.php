<?php

namespace App\Http\Controllers;

use App\Exports\ListaExport;
use App\Models\lista_asistencia;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\Http\Middleware\ShareInertiaData;
use Laravel\Jetstream\InertiaManager;

class ListaAsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }

    public function byReport($FechaInicio, $FechaFinal)
    {
       //CONSULTA PARA FILTRO DE REPORTES
       return DB::table(DB::raw('lista_asistencias'))
       ->select(DB::raw('
         cedis.nombreCEDIS,
         maniobras.nombreManiobra,
         lista_asistencias.FechaDeRegistro,
         turnos.FechaInicio,
         turnos.FechaFinal

         '))
       ->join('asistencias','lista_asistencias.asistencia_id','=','asistencias.id')
       ->join('turnos','asistencias.turno_id','=','turnos.id')
       ->join('maniobras','turnos.maniobras_id','=','maniobras.id')
       ->join('cedis','maniobras.cedis_id','=','cedis.id')
       ->whereBetween('FechaDeRegistro',[$FechaInicio,$FechaFinal])->get();
        // $lista= lista_asistencia::all();

    }


    public function export()
    {
        //
        return Excel::download(new ListaExport, 'lista.xlsx');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\lista_asistencia  $lista_asistencia
     * @return \Illuminate\Http\Response
     */
    public function show(lista_asistencia $lista_asistencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\lista_asistencia  $lista_asistencia
     * @return \Illuminate\Http\Response
     */
    public function edit(lista_asistencia $lista_asistencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\lista_asistencia  $lista_asistencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, lista_asistencia $lista_asistencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\lista_asistencia  $lista_asistencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(lista_asistencia $lista_asistencia)
    {
        //
    }
}
