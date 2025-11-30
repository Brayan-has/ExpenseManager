<?php

namespace App\Traits;
use Illuminate\Support\Facades\Cache;

trait Filter
{
    //

    public function filters($search, $query, $data, $id)
    {
        
        if($search)
        {
                $query->where(function($q) use ($search,$data){

                    foreach ($data as $field){
                        // if($field == 'id')
                        $q->orWhere($field, 'LIKE', "%$search%");

                        if(is_numeric(value: $search)){
                            $q->orWhere($field, $search);
                        }
                    }
                });
                
                
        }
       
        if($id){
            $query->where("id",$id);
        }


        return $query;
    }
}
