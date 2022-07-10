<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$users = User::all()->with('roles')) {
            return response()->json(['error' => 'Une erreur est survenue lors du chargement des utilisateurs.'], 404);
        }

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if(!$user = User::create($request->validated())) {
            return response()->json(['error' => 'Une erreur est survenue lors de la création de l\'utilisateur.'], 500);
        }

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$user = User::find($id)->with('roles')) {
            return response()->json(['error' => 'Une erreur est survenue lors du chargement de l\'utilisateur.'], 404);
        }
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        if (!$user = User::find($id)) {
            return response()->json(['error' => 'Une erreur est survenue lors du chargement de l\'utilisateur.'], 404);
        }
        $user->update($request->validated());
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!User::destroy($id)) {
            return response()->json(['error' => 'Une erreur est survenue lors de la suppression de l\'utilisateur.'], 500);
        }
        return response()->json(['success' => 'L\'utilisateur a été supprimé avec succès.'], 200);
    }
}
