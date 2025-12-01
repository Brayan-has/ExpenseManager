<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *     version="0.1",
 *     title="ExpendManager API",
 *     description="Official documentation of pos sistem AxiomaPos"
 * )
 * 
 * @OA\OpenApi(
 *   security={{"bearerAuth": {}}}
 * )
 *
 *  @OA\Server(url="http://127.0.0.1:8000/api/v0.1")
 *
 *  @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 *      description="put in here your token for try" 
 * 
 *  ) 
 */

abstract class Controller
{
    //
}
