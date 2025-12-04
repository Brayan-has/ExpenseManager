<?php

namespace App\Http\Controllers\ApiDocumentation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserDocs extends Controller
{
    /**
     * @OA\Get(
     *  path="/users",
     *  tags={"Users"},
     *  summary="All logged users with pagination and filtering",
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
     *      @OA\Schema(type="string", example="Andrew Demner")
     *  ),
     *
     *  @OA\Response(
     *      response=200,
     *      description="All users with pagination and filters",
     *      @OA\JsonContent(
     *          type="object",
     *          @OA\Property(property="content", type="array", @OA\Items(
     * 
     *          @OA\Property(property="message", type="string", example="The list of logged users"),
     *          @OA\Property(
     *              property="data",
     *              type="array",
     *              @OA\Items(
     *                  type="object",
     *                  @OA\Property(property="id", type="integer", example=2),
     *                  @OA\Property(property="name", type="string", example="Andrew"),
     *                  @OA\Property(property="lastname", type="string", example="Demner"),
     *                  @OA\Property(property="email", type="string", example="Andrew@gmail.com"),
     *
     *                  @OA\Property(
     *                      property="savings",
     *                      type="object",
     *                      @OA\Property(property="id", type="integer", example=2),
     *                      @OA\Property(property="project_name", type="string", example="Chronicle Project"),
     *                      @OA\Property(property="user_id", type="integer", example="1"),
     *                  
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
}
