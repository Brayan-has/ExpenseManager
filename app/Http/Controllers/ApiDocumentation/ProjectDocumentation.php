<?php

namespace App\Http\Controllers\ApiDocumentation;

use OpenApi\Annotations as OA;



class ProjectDocumentation
{
     /**
     * @OA\Get(
     *  path="/projects",
     *  summary="All projects for the Expend manager",
     *  
     * @OA\Response(
     *  response="200",
     *  description="success"
     * )
     * )
     */
    public function index() {}
}