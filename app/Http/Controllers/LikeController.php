<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeRequest;
use App\Models\Like;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$likes = Like::all()->with('parking', 'user')) {
            return response()->json(['error' => 'Une erreur est survenue lors du chargement des likes.'], 404);
        }
        return response()->json($likes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\LikeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LikeRequest $request)
    {
        if(!$like = Like::create($request->validated())) {
            return response()->json(['error' => 'Une erreur est survenue lors de la création du like.'], 500);
        }

        return response()->json($like, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\LikeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(LikeRequest $request)
    {
        $data = $request->validated();

        if(Like::where('id_user', $data['id_user'])->where('id_parking', $data['id_parking'])->first()) {
            return $this->store($data);
        }

        else {
            return $this->destroy($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param object $data
     * @return \Illuminate\Http\Response
     */
    public function destroy($data)
    {
        if(!$data->delete()) {
            return response()->json(['error' => 'Une erreur est survenue lors de la suppression du like.'], 500);
        }

        return response()->json(null, 204);
    }
}
