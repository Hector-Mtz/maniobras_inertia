<?php

namespace App\Exports;

use App\Models\asistencia;
use App\Models\lista_asistencia;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class ListaExport implements FromQuery, ShouldAutoSize,  WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public function query()
    {

        return DB::table('lista_asistencias')
        ->select(
            'cedis.nombreCEDIS AS CEDIS',
            'maniobras.nombreManiobra AS Maniobras',
            'turnos.NombreTurno AS Turno',
            'lista_asistencias.FechaDeRegistro AS Dia',
            DB::raw('COUNT(asistencias.turno_id) AS Asistencias'),
            DB::raw('(SELECT COUNT(id) FROM asistencias ) AS  Inscritos')
            )
        ->join('asistencias', 'lista_asistencias.asistencia_id','=','asistencias.id')
        ->join('turnos','asistencias.turno_id','=','turnos.id')
        ->join('maniobras','turnos.maniobras_id','=','maniobras.id')
        ->join('cedis','maniobras.cedis_id','=','cedis.id')
        ->groupBy('cedis.nombreCEDIS')
        ->groupBy('maniobras.nombreManiobra')
        ->groupBy('turnos.NombreTurno')
        ->groupBy('lista_asistencias.FechaDeRegistro')
        ->orderBy('lista_asistencias.id');

    }

    public function headings(): array
    {
        return ["CEDIS", "Maniobra", "Turno", "Día", "Número de asistencias", "Número de inscritos"];
    }
}



