<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Traits\Pagination;
use App\Traits\Response;
use App\Http\Requests\ProjectRequest;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    use Response, Pagination;
   
    public function index()
    {
        // get all projects with their wallets
        $projects = Project::with(["wallet:id,name,origin,quantity,project_id"])->paginate(10);

        $projects->select(["id","name","description","state","start_date","final_date"]);
       
        //pagination with Trait
        $pagination = $this->paginateData($projects);

        // if there not projects found, show a message
        if($projects->isEmpty()){
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
