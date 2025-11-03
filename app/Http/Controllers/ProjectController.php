<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Traits\Response;
use App\Http\Requests\ProjectRequest;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    use Response;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $projects = Project::with(["wallet:id,name"])->get();

        $projects->select("id","name","description","state","start_date","final_date");
       
        // dd($projects);
        // if there not projects found, show a message
        if($projects->isEmpty()){
            return $this->EasyResponse("No projects found", 404);
        }
     
       return $this->successResponse($projects, "The list of projects");
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
            return $this->easyResponse("Something went wrong", 500);
        }

         
        return $this->easyResponse( "Project created successfully", 201);
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
