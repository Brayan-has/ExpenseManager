<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Traits\Response;
use App\Traits\Pagination;
use App\Models\Saving;
use App\Http\Requests\SAvingRequest;

class SavingController extends Controller
{
    use Response,Pagination;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = request('page',1);
        $savingKey = "savings_page_{$page}";
        $ttl = 60;
         
        $savings = Cache::tags(['savings'])->remember($savingKey, $ttl, function(){
            
            $data = Saving::with(["user:id,name,lastname"])->paginate(10);
            
            if(!$data){
                return $this->errorResponse("No savings found", 404);
            }
            return $data;
        });

        $paginate = $this->paginateData($savings);
         
        return $this->successResponse($paginate, "List of savings");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SavingRequest $request)
    {
        $validate = $request->validated();
        $saving = Saving::create($validate);
        Cache::tags(['savings'])->flush();

        if(!$saving)
        {
            return $this->errorResponse("Error creating saving");
        }

        return $this->successResponse(null, "Saving created successfully");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SavingRequest $request, string $id)
    {
        $validate = $request->validated();
        $saving = Saving::find($id);

        if(!$saving)
        {
            return $this->errorResponse("saving not found");
        }

        $saving->update($validate);
        Cache::tags(['savings'])->flush();

        $saving->save();
        return $this->successResponse(null, "saving updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $saving = Saving::find($id);

        if(!$saving)
        {
            return $this->errorResponse("saving not found");
        }

        $saving->delete();
        Cache::tags(['savings'])->flush();

        return $this->successResponse(null, "saving deleted successfully");
    }
}
