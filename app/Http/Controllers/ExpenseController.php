<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        $expemses = Cache::tags(['expenses'])->remember($cacheKey, $ttl, function () use ($search, $expenseData, $id)
        {

            $data = Expense::query();
            
            $filter = $this->filters($search,$data, $expenseData,$id)->select($expenseData)->
            with(["user:id,name,lastname,email","wallet:id,name,origin"])->paginate(10)->appends(request()->query());

            return $this->paginateData($filter);

        });

        return $this->successResponse($expemses, "List of expenses");
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
