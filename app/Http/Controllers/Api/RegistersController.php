<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\RegisterResource;
use App\Models\Register;

class RegistersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registers = Register::all();
        return RegisterResource::collection($registers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $register = Register::create($request->all());
        return new RegisterResource($register);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $register = Register::findOrFail($id);
        return new RegisterResource($register);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $register = Register::findOrFail($id);
        $register->update($request->all());
        return new RegisterResource($register);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $register = Register::findOrFail($id);
        $register->delete();
        return response()->json(null, 204);
    }
}
