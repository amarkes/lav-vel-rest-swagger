<?php

namespace App\Http\Controllers;
use App\Lists;
use Illuminate\Http\Request;

use App\Http\Requests;

class ListController extends Controller
{
    public function index()
    {
        $list = Lists::orderBy('id', 'desc')->paginate(50);
        return response()->json($list);
    }
    public function show($id)
    {
        $list = Lists::find($id);

        if(!$list) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        return response()->json($list);
    }
    public function store(Request $request)
    {
        $company = new Lists();
        $company->fill($request->all());
        $company->save();

        return response()->json($company, 201);
    }
    
    public function update(Request $request, $id)
    {
        $list = Lists::find($id);

        if(!$list) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $job->fill($request->all());
        $job->save();

        return response()->json($list);
    }
    
    public function destroy($id)
    {
        $list = Lists::find($id);

        if(!$list) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $list->delete();
    }
}
