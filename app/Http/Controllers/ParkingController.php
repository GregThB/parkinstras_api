<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParkingRequest;
use App\Models\Parking;

class ParkingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$parkings = Parking::all()->with('owner', 'parking_images', 'city', 'rates', 'likes')) {
            return response()->json(['error' => 'Une erreur est survenue lors du chargement des parkings.'], 404);
        }
        return response()->json($parkings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ParkingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParkingRequest $request)
    {
        if(!$parking = Parking::create($request->validated())) {
            return response()->json(['error' => 'Une erreur est survenue lors de la création du parking.'], 500);
        }
        return response()->json($parking, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$parking = Parking::find($id)->with('owner', 'parking_images', 'city', 'rates', 'likes')) {
            return response()->json(['error' => 'Une erreur est survenue lors du chargement du parking.'], 404);
        }
        return response()->json($parking);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ParkingRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ParkingRequest $request, $id)
    {
        if (!$parking = Parking::find($id)) {
            return response()->json(['error' => 'Une erreur est survenue lors du chargement du parking.'], 404);
        }
        if(!$parking->update($request->validated())) {
            return response()->json(['error' => 'Une erreur est survenue lors de la modification du parking.'], 500);
        }
        return response()->json($parking, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Parking::destroy($id)) {
            return response()->json(['error' => 'Une erreur est survenue lors de la suppression du parking.'], 500);
        }
        
        return response()->json(['message' => 'Le parking a été supprimé avec succès.'], 200);
    }
}
