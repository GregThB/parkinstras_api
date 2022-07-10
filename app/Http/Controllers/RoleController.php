<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$roles = Role::all()) {
            return response()->json(['error' => 'Une erreur est survenue lors du chargement des rôles.'], 404);
        }
        return response()->json($roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        if(!$role = Role::create($request->validated())) {
            return response()->json(['error' => 'Une erreur est survenue lors de la création du rôle.'], 500);
        }

        return response()->json($role, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$role = Role::find($id)) {
            return response()->json(['error' => 'Une erreur est survenue lors du chargement du rôle.'], 404);
        }
        return response()->json($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\RoleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        if (!$role = Role::find($id)) {
            return response()->json(['error' => 'Une erreur est survenue lors du chargement du rôle.'], 404);
        }
        if(!$role->update($request->validated())) {
            return response()->json(['error' => 'Une erreur est survenue lors de la modification du rôle.'], 500);
        }

        return response()->json($role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Role::destroy($id)) {
            return response()->json(['error' => 'Une erreur est survenue lors de la suppression du rôle.'], 500);
        }

        return response()->json(['success' => 'Le rôle a été supprimé avec succès.'], 200);
    }
}
