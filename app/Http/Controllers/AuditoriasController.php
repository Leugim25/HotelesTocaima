<?php

namespace App\Http\Controllers;

use App\Auditorias;
use Illuminate\Http\Request;

class AuditoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auditoria = Auditorias::all();
        return view('auditoria.index', compact('auditoria'));
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
     * @param  \App\Auditorias  $auditorias
     * @return \Illuminate\Http\Response
     */
    public function show(Auditorias $auditorias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Auditorias  $auditorias
     * @return \Illuminate\Http\Response
     */
    public function edit(Auditorias $auditorias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Auditorias  $auditorias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Auditorias $auditorias)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Auditorias  $auditorias
     * @return \Illuminate\Http\Response
     */
    public function destroy(Auditorias $auditorias)
    {
        //
    }
}
