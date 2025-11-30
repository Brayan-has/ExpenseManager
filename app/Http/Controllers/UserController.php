<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\User; 
use App\Http\Requests\UserRequest;
use App\Traits\Response;
use App\Traits\Pagination;
use App\Traits\Filter;
use Ramsey\Uuid\DeprecatedUuidMethodsTrait;

class UserController extends Controller
{
    use Response,Pagination, Filter;
    /**
     * Display a listing of the resource.
     */
    public function index(UserRequest $request)
    {

        #  filters section
        $search = $request->input('search');
        $id = $request->input('id');
        $usersData = ['id','name','lastname','email','password'];

        #cache key section
        $page = $request->input('page', 1);
        
        $userKey = "users_page_{$page}_search_". md5($search ?? 'none') . "_id_" . ($id ?? 'none');
        $ttl = 60;

        $usersData = Cache::tags(['users'])->remember($userKey, $ttl, function () use ($usersData, $search,$id) {
            
            $users = user::query();
              
            $filters = $this->filters($search,$users,$usersData,$id)->select($usersData)->with('savings:id,project_name,user_id')->paginate(10);


            return $this->paginateData($filters);
        });

        
        if(!$usersData){
            return $this->errorResponse("No users found.",404);
        }

        return $this->successResponse($usersData, "Users retrieved successfully.");
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();
        $user = User::create($validated);
        if(!$user){
            return $this->errorResponse("User could not be created.",500);
        }
        Cache::tags(['users'])->flush();
        return $this->successResponse("null", "User created successfully.",201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $validated = $request->validated();
        $user = User::find($id);
        
        if(!$user){
            return $this->errorResponse("User not found.",404);
        }
        
        $user->update($validated);
        Cache::tags(['users'])->flush();
        
        $user->save();

        return $this->successResponse("null", "User updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if(!$user){
            return $this->errorResponse("User not found.",404);
        }

        $user->delete();
        Cache::tags(['users'])->flush();
        return $this->successResponse("null", "User deleted successfully.");
    }
}
