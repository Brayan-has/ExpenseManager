<?php

namespace App\Traits;

trait Pagination
{
    //
    public function paginateData($data)
    {
        $pagination = [
            "data" => $data->items(),
            "current_page" => $data->currentPage(),
            "per_page" => $data->perPage(),
            "total" => $data->total(),
            "next_page_url" => $data->nextPageUrl(),
            "prev_page_url" => $data->previousPageUrl(),
        ];

        return $pagination;
    }
}
