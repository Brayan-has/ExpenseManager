<?php

namespace App\Http\Controllers;


// documentation using swagger, this is the global config

/**
 * @OA\Info(
 *  title="ExpendManager Docs",
 *  version=1.0.0,
 * )
 * @OA\SecurityScheme(
 *  type="http",
 *  securityScheme="baererAuth",
 *  scheme="baerer",
 *  bearerFormat="JWT"
 * )
 */
abstract class Controller
{

    //
}
