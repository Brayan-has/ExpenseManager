<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use Illuminate\Database\Query\Expression;
use Illuminate\support\Facades\Cache;
use App\Models\Expense;
use App\Traits\Filter;
use App\Traits\Pagination;
use App\Traits\Response;

class ExpenseController extends Controller
{
    use Response, Pagination, filter;
    public function index()
    {

        // filter section
        $expenseData = ["id","name","description","value","date","status","daily","by_week","by_month","annual","user_id","wallet_id"];
        $search = request("search");
        $id = request("id");

        
        // cache dection
        $page = request("page",1);
        $ttl = 60; // 1 minute to expire the cache
        $cacheKey = "expenses_{$page}_search_". md5($search ?? 'none') . "_id_". ($id ?? "none");

        $expenses = Cache::tags(['expenses'])->remember($cacheKey, $ttl, function () use ($search, $expenseData, $id)
        {

            $data = Expense::query();
            
            $filter = $this->filters($search,$data, $expenseData,$id)->select($expenseData)->
            with(["user:id,name,lastname,email","wallet:id,name,origin"])->paginate(10)->appends(request()->query());

            
            return $this->paginateData($filter);
        });
        

        return $this->successResponse($expenses, "List of expenses");
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpenseRequest $request)
    {
        $validate = $request->validated();

        $expense = Expense::create($validate);

        if(!$expense){
            return $this->errorResponse("Error creating the expense",500);
        }

        Cache::tags(["expenses"])->flush();
        return $this->successResponse($expense, "Expense created successfully",201);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseRequest $request, string $id)
    {
         //
        $validated = $request->validated();

        // getting all projects by id
        $project = Expense::find($id);

        if(!$project){
            return $this->errorResponse("Expense not found");
        }

        $project->fill($validated);
        $project->save();

        Cache::tags(['expenses'])->flush();


        return $this->easyResponse("The expense was updated correctly");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // getting all projects by id
        $project = Expense::find($id);
        
        // if there's no project found
        if(!$project){
            return $this->errorResponse("Project not found");
        }

        $project->delete();
        Cache::tags(['expenses'])->flush();

        return $this->easyResponse("The project was delete it correctly");

    }
}
