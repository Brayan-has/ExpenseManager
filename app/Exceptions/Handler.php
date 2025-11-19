<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Request;
use Throwable;
use app\Exceptions\CrudException;

// ruta de la excepción de validación:
use Illuminate\Validation\ValidationException;

// methdo not allowed
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
 
use \BadMethodCallException;
// 
use Illuminate\Database\UniqueConstraintViolationException;
// 
use Illuminate\Database\QueryException;
use Spatie\Permission\Exceptions\RoleDoesNotExist;



class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e )
    {

        switch($e)
        {
            case $e instanceof MethodNotAllowedHttpException:
                return response()->json([
                    "message" => "Métod not allowed",
                    "method used" => $request->method()
                ],500);
            case $e instanceof BadMethodCallException:
                return response()->json([
                    "message" => "This format is not allowed or is not working",
                    "error" => $e->getMessage()
                ],500);
            case $e instanceof UniqueConstraintViolationException:
                return response()->json([
                    "message" => "The data for this resource already exist"
                ],400);
    
            case $e instanceof QueryException:
                return response()->json([
                    "message" => "incorrect format",
                    "error" => $e->errorInfo
                ],400);

            case $e instanceof RoleDoesNotExist:
                return response()->json([
                    "error" => "something was wrong",
                    "message" => $e->getMessage()
                ]);
        }                   
            

        return parent::render($request, $e);


    }
}
