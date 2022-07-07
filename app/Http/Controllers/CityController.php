<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use App\Models\City;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!$cities = City::all()) {
            return response()->json(['error' => 'Une erreur est survenue lors du chargement des villes.'], 404);
        }
        return response()->json($cities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        if(!$city = City::create($request->all())) {
            return response()->json(['error' => 'Une erreur est survenue lors de la création de la ville.'], 500);
        }
        return response()->json($city, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$city = City::find($id)) {
            return response()->json(['error' => 'Une erreur est survenue lors du chargement de la ville.'], 404);
        }
        return response()->json($city);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\CityRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, $id)
    {
        if (!$city = City::find($id)) {
            return response()->json(['error' => 'Une erreur est survenue lors du chargement de la ville.'], 404);
        }

        if($data = $request->validated()) {
            return response()->json();
        }
    
        if(!$city->update($data)) {
            return response()->json(['error' => 'Une erreur est survenue lors de la modification de la ville.'], 500);
        }

        return response()->json($city, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!City::destroy($id)) {
            return response()->json(['error' => 'Une erreur est survenue lors de la suppression de la ville.'], 500);
        }
        return response()->json(null, 204);
    }
}
