<?php

namespace App\Http\Controllers;

use App\Models\asistencia;
use App\Models\cedi;
use App\Models\maniobra;
use App\Models\cliente;
use App\Models\documento;
use App\Models\lista_asistencia;
use App\Models\monto;
use App\Models\turno;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\Promise\all;

class ManiobraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        //Traemos estos de inicio
        $cedis = cedi::all();
        $clientes = cliente::all();
        $turnos = [];
        $maniobras = [];
        $asistencias= [];
        $users = User::where('rol_id', 'like','%2%')->get();
        $montos = monto::all();
        $documentos = documento::all();
        $lista_asistencias = [];

        //Funciones para ocultar elementos HTML
        $load_data_maniobras = 'false'; //no debe mostrarse si es true
        $load_data_turnos = 'false';

        $cedis_id = $request->get('idCedis'); //recibimos el id desde la vista

        $maniobra_id = $request->get('idManiobra'); //recibimos el id desde la vista

        $turno_id = $request->get('idTurno');

        if(isset($_REQUEST['idCedis'])) //si existe el cedis_id declarara las sig variables
        {
           $maniobras = maniobra::where('cedis_id','like','%'.$cedis_id.'%')->
                                 where('activo',1)->get(); //declara el array de maniobras dependiendo el cedis_id

        }

        if(!isset($_REQUEST['idCedis']))
        {
            $maniobras = [];
        }


        if(isset($_REQUEST['idManiobra']))
        {
             //Turnos
            $turnos=
            DB::table(DB::raw('turnos t, maniobras  m, cedis  c'))
            ->select(DB::raw(
                't.id as idTurno,
                t.maniobras_id,
                t.NombreTurno,
                t.FechaInicio,
                t.FechaFinal,
                t.HoraInicio,
                t.HoraFinal,
                t.NumeroManiobristas,
                t.rango,
                t.nota,
                m.id as idManiobra,
                m.cedis_id,
                m.nombreManiobra,
                m.activo,
                c.id as idCedis,
                c.nombreCEDIS,
                c.cliente_id,
                c.coordenadas'
                ))
            ->where('maniobras_id','like','%'.$maniobra_id.'%')->get();


            //Asistencias
            $asistencias = DB::table('asistencias')
            ->join('users','asistencias.user_id','=','users.id')
            ->join('montos', 'asistencias.monto_id','=','montos.id')
            ->where('asistencias.turno_id','=',''.$turno_id.'')
            ->where('asistencia','=','1')
            ->get();

            $lista_asistencias = lista_asistencia::all()
            ->join('turnos', 'lista_asistencias.turno_id','=','turno.id');
        }



        return Inertia::render('Maniobras',[
            'cedis'=> $cedis,
            'clientes' =>$clientes,
            'maniobras' => $maniobras,
            'turnos'=> $turnos,
            'users' => $users,
            'montos' => $montos,
            'documentos' => $documentos,
            'load_data_maniobras' => $load_data_maniobras,
            'load_data_turnos' => $load_data_turnos,
            'maniobra_id' => $maniobra_id,
            'asistencias' => $asistencias,
            'lista_asistencias' => $lista_asistencias
        ]);
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
        maniobra::create(
            $request->validate([
                'nombreManiobra' => ['required', 'max:50'],
                'cedis_id' => ['required', 'max:50'],
                'activo' => ['required', 'max:50'],
            ])
        );
        return  redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\maniobra  $maniobra
     * @return \Illuminate\Http\Response
     */
    public function show(maniobra $maniobra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\maniobra  $maniobra
     * @return \Illuminate\Http\Response
     */
    public function edit(maniobra $maniobra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\maniobra  $maniobra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, maniobra $maniobra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\maniobra  $maniobra
     * @return \Illuminate\Http\Response
     */
    public function destroy(maniobra $maniobra)
    {
        //
    }
}
