<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Traits\Pagination;
use App\Traits\Response;
use App\Traits\Filter;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Cache;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    use Response, Pagination, Filter;
   
    public function index()
    {

        
        $endpointData = ["id","name","description","state","start_date","final_date"];
        $id = request("id");
        // variable to get the data for search end filter any data needed 
        $search = request("search");
        
        //get the current page
        $page = request("page",1);
        
        // CacheKey
        $cacheKey = "project_page_{$page}_search_" . md5($search ?? 'none').  "_id_". ($id ?? "none");
        
        // 1 minute to expire the cache
        $ttl = 60; 
        
        # Redis implementation
        $pagination = Cache::tags(['projects'])->remember($cacheKey, $ttl, function () use ($search, $endpointData, $id) {               

            
            //consturctor of the queryBulder to get the projects 
            $query = Project::query();
            
            // call of the trait filter to aplly filters at the query builder
            // get all projects with their wallets
            $projects= $this->filters($search, $query, $endpointData,$id)->with(["wallet:id,name,origin,quantity,project_id"])->
            select($endpointData)->paginate(10)->appends(request()->query());
        
            // if there not projects found, show a message
            if(!$projects){
                return $this->noData("No projects found");
            }
            
            return $this->paginateData($projects);
        });
        
        if (!$pagination) {
            return $this->noData("No projects found");
        }        

        return $this->successResponse($pagination, "The list of projects");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        // validate if the data set is correct
        $validated = $request->validated();

        //if the request is ok create the project 
        $project = Project::create($validated);

        Cache::tags(['projects'])->flush();
        // if someting went wrong
        if(!$project){
            return $this->errorResponse("Something went wrong");
        }

         
        return $this->easyResponse( "Project created successfully");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, string $id)
    {
        //
        $validated = $request->validated();

        // getting all projects by id
        $project = Project::find($id);

        if(!$project){
            return $this->errorResponse("Project not found");
        }

        $project->fill($validated);
        $project->save();

        Cache::tags(['projects'])->flush();


        return $this->easyResponse("The project was updated correctly");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // getting all projects by id
        $project = Project::find($id);
        
        // if there's no project found
        if(!$project){
            return $this->errorResponse("Project not found");
        }

        $project->delete();

        return $this->easyResponse("The project was delete it correctly");

    }
}
