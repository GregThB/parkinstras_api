<?php

namespace App\Http\Controllers;

use App\Http\Requests\RateRequest;
use App\Models\Rate;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$rates = Rate::all()->with('user', 'parking')) {
            return response()->json(['error' => 'Une erreur est survenue lors du chargement des taux.'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RateRequest $request)
    {
        if(!$rate = Rate::create($request->validated())) {
            return response()->json(['error' => 'Une erreur est survenue lors de la création du taux.'], 500);
        }

        return response()->json($rate, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$rate = Rate::find($id)) {
            return response()->json(['error' => 'Une erreur est survenue lors du chargement du taux.'], 404);
        }
        return response()->json($rate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\RateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RateRequest $request, $id)
    {
        if (!$rate = Rate::find($id)) {
            return response()->json(['error' => 'Une erreur est survenue lors du chargement du taux.'], 404);
        }
        if (!$rate->update($request->validated())) {
            return response()->json(['error' => 'Une erreur est survenue lors de la modification du taux.'], 500);
        }
        return response()->json($rate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Rate::destroy($id)) {
            return response()->json(['error' => 'Une erreur est survenue lors de la suppression du taux.'], 500);
        }
        return response()->json(['success' => 'Le taux a été supprimé avec succès.'], 200);
    }
}
