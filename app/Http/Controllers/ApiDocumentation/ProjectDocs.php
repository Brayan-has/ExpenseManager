<?php

namespace App\Http\Controllers\ApiDocumentation;

use OpenApi\Annotations as OA;



class ProjectDocs
{
    /**
     * @OA\Get(
     *  path="/projects",
     *  tags={"Projects"},
     *  summary="All projects for the Expend manager with pagination and filtering",
     *
     *  @OA\Parameter(
     *      name="id",
     *      in="query",
     *      description="Filter by project ID",
     *      @OA\Schema(type="integer")
     *  ),
     *  @OA\Parameter(
     *      name="search",
     *      in="query",
     *      description="Search term to filter projects",
     *      @OA\Schema(type="string", example="project to save money")
     *  ),
     *
     *  @OA\Response(
     *      response=200,
     *      description="All projects with pagination and filters",
     *      @OA\JsonContent(
     *          type="object",
     *          @OA\Property(property="content", type="array", @OA\Items(
     * 
     * 
     * 
     * 
     *          @OA\Property(property="message", type="string", example="The list of projects"),
     *          @OA\Property(
     *              property="data",
     *              type="array",
     *              @OA\Items(
     *                  type="object",
     *                  @OA\Property(property="id", type="integer", example=2),
     *                  @OA\Property(property="name", type="string", example="Andrew Demner"),
     *                  @OA\Property(property="description", type="string", example="Super important wallet description"),
     *                  @OA\Property(property="state", type="string", example="1984-09-09 00:00:00"),
     *                  @OA\Property(property="final_date", type="string", example="1984-09-09 00:00:00"),
     *
     *                  @OA\Property(
     *                      property="wallet",
     *                      type="object",
     *                      @OA\Property(property="id", type="integer", example=2),
     *                      @OA\Property(property="name", type="string", example="lunch wallet"),
     *                      @OA\Property(property="description", type="string", example="Principal wallet"),
     *                      @OA\Property(property="origin", type="string", example="entry principal"),
     *                      @OA\Property(property="quantity", type="integer", example=18000000)
     *                  )
     *              )
     *          ),
     *
     *          @OA\Property(property="current_page", type="integer", example=1),
     *          @OA\Property(property="per_page", type="integer", example=10),
     *          @OA\Property(property="total", type="integer", example=50),
     *          @OA\Property(property="next_page_url", type="string", example="http://api.com/projects?page=2"),
     *          @OA\Property(property="prev_page_url", type="string", example=null)
     *      )
     *  )
     * )),
     * )
     */
    public function index() {}

    /**
     * @OA\Post(
     *  path="/projects",
     *  tags={"Projects"},
     *  summary="Create projects",
     * 
     *   @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(
     *          required={"name","description","state"},
     *          @OA\Property(property="name", type="string", example="Sale enterprise"),
     *          @OA\Property(property="description", type="string", example="Sale's company"),
     *          @OA\Property(property="state", type="string", example="On progress"),
     *      )
     *  ),
     * 
     * @OA\Response(
     *      response=200,
     *      description="Creation of the project",
     *      @OA\JsonContent(
     *          @OA\Property(property="message", type="string", example="Project created successfully"),
     *      )
     * )
     *
     * )
     */
    public function store() {}

    /**
     * @OA\Put(
     *  path="/projects/{id}",
     *  tags={"Projects"},
     *  summary="Update data from a project",
     *  
     * 
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(type="integer", example=3)
     *  ),
     * 
     *  @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(
     *          required={"name","description","state"},
     *          @OA\Property(property="name", type="string", example="Sale enterprise"),
     *          @OA\Property(property="description", type="string", example="Sale's company"),
     *          @OA\Property(property="state", type="string", example="On progress"),
     *          @OA\Property(property="start_date", type="date", example="1992-02-17 00:00:00"),
     *          @OA\Property(property="final_date", type="date", example="final_date"),
     *          @OA\Property(property="user_id", type="integer", example=3)
     *      )
     * ),
     *
     * @OA\Response(
     *      response=200,
     *      description="Updating the project data",
     *      @OA\JsonContent(
     *          @OA\Property(property="message", type="string", example="The project was updated correctly")
     *      
     *      )
     * )
     * 
     * 
     * )
     */
    public function update() {}

    /**
     * @OA\Delete(
     *  path="/projects/{id}",
     *  tags={"Projects"},
     *  summary="Delete any project by the id",
     * @OA\Parameter(
     *  name="id",
     *  in="path",
     *  description="Delete",
     *  required=true,
     *  @OA\Schema(type="integer", example="2")
     *  ),
     *  
     * @OA\Response(
     *      response=200,
     *      description="",
     *      @OA\JsonContent(
     *          @OA\Property(property="message", type="string", example="The project was deleted correctly")
     *       )
     *  )
     * )
     **/
    public function delete() {}
}