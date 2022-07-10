<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParkingImageRequest;
use App\Models\ParkingImage;

class ParkingImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$parkingImages = ParkingImage::all()->with('parking')) {
            return response()->json(['error' => 'Une erreur est survenue lors du chargement des images.'], 404);
        }

        return response()->json($parkingImages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ParkingImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParkingImageRequest $request)
    {
        if(!$parkingImage = ParkingImage::create($request->validated())) {
            return response()->json(['error' => 'Une erreur est survenue lors de la création de l\'image.'], 500);
        }

        return response()->json($parkingImage, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$parkingImage = ParkingImage::find($id)) {
            return response()->json(['error' => 'Une erreur est survenue lors du chargement de l\'image.'], 404);
        }

        return response()->json($parkingImage);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ParkingImageRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ParkingImageRequest $request, $id)
    {
        if (!$parkingImage = ParkingImage::find($id)) {
            return response()->json(['error' => 'Une erreur est survenue lors du chargement de l\'image.'], 404);
        }

        if (!$parkingImage->update($request->validated())) {
            return response()->json(['error' => 'Une erreur est survenue lors de la modification de l\'image.'], 500);
        }

        return response()->json($parkingImage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!ParkingImage::destroy($id)) {
            return response()->json(['error' => 'Une erreur est survenue lors de la suppression de l\'image.'], 500);
        }

        return response()->json(['success' => 'L\'image a été supprimée avec succès.'], 200);
    }
}
