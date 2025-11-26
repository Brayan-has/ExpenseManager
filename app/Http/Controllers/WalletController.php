<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Wallet;
use App\Traits\Pagination;
use App\Traits\Response;
use App\Http\Requests\WalletRequest;

class WalletController extends Controller
{
    use Response, Pagination;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // key of the cache for wallets 
        $walletKey = "wallet_all";

        $ttl = 60; // Time to live in seconds

        $wallet = Cache::tags(['wallets'])->remember($walletKey, $ttl, function(){

            // return $wallet;
            $wallet = Wallet::paginate(10);
    
            $wallet = $this->paginateData($wallet);
            // If there's no data show an error message
            
            if (!$wallet){
                return $this->noData("No wallets found");
            }
            return $wallet;
        });

        return $this->successResponse($wallet,"List of wallets");
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WalletRequest $request)
    {
        //
        $validated = $request->validated();
        
        $wallet = Wallet::create($validated);
        Cache::tags(['wallets'])->flush();
        
        if(!$wallet){
            return $this->errorResponse("Failed to create wallet");
        }
        
        return $this->successResponse($wallet,"Wallet created successfully");

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $wallet = Wallet::find($id);
        
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
