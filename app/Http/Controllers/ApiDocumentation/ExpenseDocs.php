<?php

namespace App\Http\Controllers\ApiDocumentation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpenseDocs extends Controller
{
    /**
     * @OA\Get(
     *  path="/expenses",
     *  tags={"Expenses"},
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
     *      description="Search term to filter expenses",
     *      @OA\Schema(type="string", example="Fugiat nesciunt voluptatibus libero molestiae.")
     *  ),
     *
     *  @OA\Response(
     *      response=200,
     *      description="All expenses with pagination and filters",
     *      @OA\JsonContent(
     *          type="object",
     *          @OA\Property(property="content", type="array", @OA\Items(
     * 
     * 
     * 
     * 
     *          @OA\Property(property="message", type="string", example="The list of expenses"),
     *          @OA\Property(
     *              property="data",
     *              type="array",
     *              @OA\Items(
     *                  type="object",
     *                  @OA\Property(property="id", type="integer", example=2),
     *                  @OA\Property(property="name", type="string", example="Fugiat nesciunt voluptatibus libero molestiae."),
     *                  @OA\Property(property="description", type="string", example="List of expenses"),
     *                  @OA\Property(property="value", type="integer", example=500000),
     *                  @OA\Property(property="date", type="string", example="1984-09-09 00:00:00"),
     *                  @OA\Property(property="status", type="string", example="Pending"),
     *                  @OA\Property(property="daily", type="boolean", example="1"),
     *                  @OA\Property(property="by_week", type="boolean", example="0"),
     *                  @OA\Property(property="by_moth", type="boolean", example="0"),
     *                  @OA\Property(property="annual", type="boolean", example="0" ),
     * 
     *          
     *                  @OA\Property(
     *                      property="user",
     *                      type="object",
     *                      @OA\Property(property="id", type="integer", example=2),
     *                      @OA\Property(property="name", type="string", example="lunch wallet"),
     *                      @OA\Property(property="lastname", type="string", example="Principal wallet"),
     *                      @OA\Property(property="email", type="string", example="entry principal"),
     *                  ),
     * 
     *                  @OA\Property(
     *                      property="wallet",
     *                      type="object",
     *                      @OA\Property(property="id", type="integer", example=1),
     *                      @OA\Property(property="name", type="string", example="Agaval Wallet"),
     *                      @OA\Property(property="origin", type="string", example="Sales")
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
     *  @OA\Post(
     *     path="/expenses",
     *     tags={"Expenses"},
     *     summary="Create an expense resource",
     * @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(
     *          required={"name", "description", "value", "date", "status","daily", "by_moth","by_week", "annual", "user_id", "wallet_id"},
     *          @OA\Property(property="name", type="string", example="Agaval Expenses"),
     *          @OA\Property(property="description", type="string", example="Expenses from the Agaval company"),
     *          @OA\Property(property="value", type="integer", example="500000000"),
     *          @OA\Property(property="date", type="date", example="1984-09-09 00:00:00"),
     *          @OA\Property(property="status", type="string", example="Finished"),
     *          @OA\Property(property="daily", type="boolean", example=1),
     *          @OA\property(property="by_moth", type="boolean", example=0),
     *          @OA\Property(property="by_week", type="boolean", example=0),
     *          @OA\Property(property="annual", type="boolean", example=0),
     *          @OA\Property(property="user_id", type="integer", example=1),
     *          @OA\Property(property="wallet_id", type="integer", example=3)
     *      )
     * ),
     * @OA\Response(
     *      response=200,
     *      description="",
     *      @OA\JsonContent(
     *          @OA\Property(property="message", type="string", example="Expense created successfully")
     *      )
     *  )
     *  ),
     */
    public function store() {}

    /**
     * @OA\Put(
     *    path="/expenses/{id}",
     *    tags={"Expenses"},
     *    summary="Update any data from expense by the expense id",
     * 
     *    @OA\Parameter(
     *      name="id",
     *      required=true,
     *      in="query",
     *      description="",
     *      @OA\Schema(type="string", example="1")
     * 
     *    ),
     * 
     *    @OA\RequestBody(
     *         @OA\JsonContent(
     * 
     * 
     *          @OA\Property(property="name", type="string", example="Agaval Expenses"),
     *          @OA\Property(property="description", type="string", example="Expenses from the Agaval company"),
     *          @OA\Property(property="value", type="integer", example="500000000"),
     *          @OA\Property(property="date", type="date", example="1984-09-09 00:00:00"),
     *          @OA\Property(property="status", type="string", example="Finished"),
     *          @OA\Property(property="daily", type="boolean", example=1),
     *          @OA\property(property="by_moth", type="boolean", example=0),
     *          @OA\Property(property="by_week", type="boolean", example=0),
     *          @OA\Property(property="annual", type="boolean", example=0),
     *          @OA\Property(property="user_id", type="integer", example=1),
     *          @OA\Property(property="wallet_id", type="integer", example=3)
     *         )
     *    ),
     * 
     * @OA\Response(
     *      response=200,
     *      description="",
     *      @OA\JsonContent(
     *      @OA\Property(property="message", type="string", example="The expense was updated correctly")
     * 
     *      )
     *  )
     * )
    */
    public function update() {}

    /**
     * @OA\Delete(
     *     path="/expenses/{id}",
     *     tags={"Expenses"},
     *     summary="Delete an expense wallet by the expense id",
     * 
     *     @OA\Parameter(
     *          required=true,
     *          name="id",
     *          description="id to eliminate the specific expense",
     *          in="query",
     *          @OA\Schema(type="integer", example="1")
     *      ),
     * 
     *      @OA\Response(
     *          response=200,
     *          description="",
     *          @OA\JsonContent(
     *             @OA\Property(property="message", example="The project was delete it correctly")
     * 
     *          )
     *          
     * 
     *      )
     * 
     * 
     * )
    */
    public function delete() {}
}
