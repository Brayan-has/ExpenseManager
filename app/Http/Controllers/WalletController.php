<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Wallet;
use App\Traits\Pagination;
use App\Traits\Response;
use App\Traits\Filter;
use App\Http\Requests\WalletRequest;

class WalletController extends Controller
{
    use Response, Pagination, Filter;
    /**
     * Display a listing of the resource.
     */
    public function index(WalletRequest $request)
    {
        #filter section
        $search = $request->input('search');
        $id = $request->input('id');
        $walletData = ['id','name','origin','quantity','project_id'];

        #Cache section
        # page for add it at the cache key
        $page = request("page",1);
         
        // key of the cache for wallets 
        $walletKey = "wallet_page_{$page}_search_" . md5($search ?? 'none') . "_id_" . ($id ?? "none");
        $ttl = 60; // Time to live in seconds


        $wallet = Cache::tags(['wallets'])->remember($walletKey, $ttl, function() use ($walletData, $search, $id){ 

            // return $wallet;
            $wallet = Wallet::query();
            
            $filter = $this->filters($search,$wallet, $walletData,$id)
            ->select($walletData)->paginate(10)->appends(request()->query());
    
            $wallet = $this->paginateData($filter);
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
        
        return $this->successResponse(null,"Wallet created successfully");

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $wallet = Wallet::find($id);
        
        if(!$wallet){
            return $this->noData("Wallet not found");
        }
        
        $wallet->update($request->all());
        Cache::tags(['wallets'])->flush();
        $wallet->save();

        return $this->successResponse(null,"Wallet updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $wallet = Wallet::find($id);
        
        if(!$wallet){
            return $this->noData("Wallet not found");
        }
        
        $wallet->delete();
        Cache::tags(['wallets'])->flush();

        return $this->successResponse(null,"Wallet deleted successfully");
    }
}
