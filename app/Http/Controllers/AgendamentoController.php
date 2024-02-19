<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Agendamento;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AgendamentoController extends Controller
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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

     public function pesquisar(Request $request)
    {

        try {
        $data = $request->input('data_evento');
        $horaInicio = $request->input('hora_inicio');
        $horaTermino = $request->input('hora_termino');

        $resultados = Agendamento::where('data_evento', $data)
                        ->where(function($query) use ($horaInicio, $horaTermino) {
                            $query->whereBetween('hora_inicio', [$horaInicio, $horaTermino])
                                  ->orWhereBetween('hora_termino', [$horaInicio, $horaTermino]);
                        })
                        ->first();
            return response()->json($resultados);
            
        } catch (\Exception $e) {
            // Logue a exceção
            \Log::error('Erro na pesquisa: ' . $e->getMessage());
            
            // Retorne uma resposta de erro genérica
            return response()->json(['error' => 'Erro interno do servidor'], 500);
        }
    }
}
