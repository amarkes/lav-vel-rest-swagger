<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class ResponseAPI extends Controller
{
    function res($response = null, $status = 200, $message = 'Query sucess')
    {
        return response()->json([
            'total'           => $response ? $response->total() : 0,
            'messagem'        => $message ? $message : 'Query sucess',
            'status'          => $status,
            'per_page'        => $response ? $response->perPage() : 0,
            'current_page'    => $response ? $response->currentPage() : 0,
            'last_page'       => $response ? $response->lastPage() : 0,
            'next_page_url'   => $response ? $response->nextPageUrl() : null,
            'prev_page_url'   => $response ? $response->previousPageUrl() : null,
            'result'          => $response ? $response->items() : [],
        ], $status ? $status : 200);
    }
}
