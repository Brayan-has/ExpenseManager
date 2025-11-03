<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Traits\Response;
use App\Http\Requests\WalletRequest;

class WalletController extends Controller
{
    use Response;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $wallet = Wallet::all();

        // If there's no data show an error message
        
        if ($wallet->isEmpty()){
            return $this->noData("No wallets found");
        }
        return $this->successResponse($wallet,"Listo of wallets");
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WalletRequest $request)
    {
        //
        $validated = $request->validated();
        
        $wallet = Wallet::create($validated);
        
        if(!$wallet){
            return $this->errorResponse("Failed to create wallet");
        }
        
        return $this->successResponse($wallet,"Wallet created successfully");

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
        // return response()->json(['message' => 'Update method not implemented yet.'], 501);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
