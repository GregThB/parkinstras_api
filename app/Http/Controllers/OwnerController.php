<?php

namespace App\Http\Controllers;

use App\Http\Requests\OwnerRequest;
use App\Models\Owner;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$owners = Owner::all()) {
            return response()->json(['error' => 'Une erreur est survenue lors du chargement des propriétaires.'], 404);
        }
        return response()->json($owners);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OwnerRequest $request)
    {   
        if(!$owner = Owner::create($request->validated())) {
            return response()->json(['error' => 'Une erreur est survenue lors de la création du propriétaire.'], 500);
        }
        
        return response()->json($owner, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$owner = Owner::find($id)) {
            return response()->json(['error' => 'Une erreur est survenue lors du chargement du propriétaire.'], 404);
        }
        return response()->json($owner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\OwnerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OwnerRequest $request, $id)
    {
        if (!$owner = Owner::find($id)) {
            return response()->json(['error' => 'Une erreur est survenue lors du chargement du propriétaire.'], 404);
        }
        if(!$owner->update($request->validated())) {
            return response()->json(['error' => 'Une erreur est survenue lors de la modification du propriétaire.'], 500);
        }
        return response()->json($owner);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Owner::destroy($id)) {
            return response()->json(['error' => 'Une erreur est survenue lors de la suppression du propriétaire.'], 500);
        }
        return response()->json(['message' => 'Le propriétaire a été supprimé avec succès.'], 204);
    }
}
