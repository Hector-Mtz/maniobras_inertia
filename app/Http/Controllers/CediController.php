<?php

namespace App\Http\Controllers;

use App\Models\cedi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CediController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $cedis; //declaramos deonde se van a alamacenar los cedis

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
        cedi::create(
            $request->validate([
                'nombreCEDIS' => ['required', 'max:50'],
                'cliente_id' => ['required', 'max:50'],
                'coordenadas' =>['required', 'max:50']
            ])
        );
        return  redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cedi  $cedi
     * @return \Illuminate\Http\Response
     */
    public function show(cedi $cedi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cedi  $cedi
     * @return \Illuminate\Http\Response
     */
    public function edit(cedi $cedi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cedi  $cedi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cedi $cedi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cedi  $cedi
     * @return \Illuminate\Http\Response
     */
    public function destroy(cedi $cedi)
    {
        //
    }

}
