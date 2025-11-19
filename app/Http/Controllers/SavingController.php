<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Response;
use App\Models\Saving;

class SavingController extends Controller
{
    use Response;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $saving = Saving::with(["user:id,name,lastname"])->get();

        if(empty($saving)){
            return $this->errorResponse("No savings found", 404);
        }
        return response()->json([
            "message" => $saving
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
