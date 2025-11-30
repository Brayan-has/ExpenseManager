<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Traits\Response;
use App\Traits\Pagination;
use App\Traits\Filter;
use App\Models\Saving;
use App\Http\Requests\SAvingRequest;

class SavingController extends Controller
{
    use Response,Pagination, Filter;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$savingData 
        $savingData =['project_name','saving_value','status','user_id'];
        // Request id for filter
        $id = request('id');
        //search variable
        $search = request('search');

        $page = request('page',1);
        $savingKey = "saving_page_{$page}_search_" . md5($search ?? 'none'). "_id_" . ($id ?? "none");
        $ttl = 60;
         
        $savings = Cache::tags(['savings'])->remember($savingKey, $ttl, function() use ($savingData, $id,$search) {
            
            $data = Saving::query();
            
            //filter with pagination and relationships
            $filters = $this->filters($search,$data,$savingData, $id)->select($savingData)->
            with(["user:id,name,lastname"])->paginate(10)->appends(request()->query());
            
            if(!$filters){
                return $this->errorResponse("No savings found", 404);
            }
            return $filters;
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
