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

    public $trabajador = null, $selectedMonto = null;

    public function index(Request $request)
    {
        //Traemos estos de inicio
        $cedis = cedi::all();
        $clientes = cliente::all();
        $turnos = [];
        $maniobras = [];
        $asistencias= [];
        $users = User::where('rol_id', 'like','%2%')->get();
        $montos = null;
        $documentos = documento::all();
        $lista_asistencias = [];

        $turnoSelect = $request->post('turnoSelect');

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
            DB::table(DB::raw('turnos t'))
            ->select(DB::raw(
                't.id AS idTurno,
                t.maniobras_id,
                t.NombreTurno,
                t.FechaInicio,
                t.FechaFinal,
                t.HoraInicio,
                t.HoraFinal,
                t.NumeroManiobristas,
                t.rango,
                t.nota,
                m.id AS idManiobra,
                m.cedis_id,
                m.nombreManiobra,
                m.activo,
                c.id AS idCedis,
                c.nombreCEDIS,
                c.cliente_id,
                c.coordenadas
                '
                ))
            ->join('maniobras AS m','t.maniobras_id','=','m.id')
            ->join('cedis AS c','m.cedis_id','=','c.id')
            ->where('t.maniobras_id','like','%'.$maniobra_id.'%')->get();

            //DEBEN APARECER  DEPENDIENDO EL TURNO QUE SE DE EN EL SELECT
             $asistencias = asistencia::
                                        join('users','asistencias.user_id','=','users.id')
                                       ->join('montos','asistencias.monto_id','=','montos.id')
                                       ->where('asistencias.turno_id','like','%'.$turno_id.'%')
                                       ->get();

        }

        if(isset($turnoSelect)){
            $montos= monto::where('turno_id','like','%'.$turnoSelect.'%')->get();
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
