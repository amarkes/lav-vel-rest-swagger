<?php
/**
 * @SWG\Swagger(
 *   basePath="/rest",
 *   @SWG\Info(
 *     title="Teste de lista",
 *     version="1.0.0"
 *   )
 * )
 */
namespace App\Http\Controllers;
use App\Lists;
use Illuminate\Http\Request;

use App\Http\Requests;

class ListController extends Controller
{
/**
 * @SWG\Get(
 *   path="/list",
 *   summary="List",
 *   operationId="getAllList",
 *   @SWG\Response(response=200, description="successful operation"),
 *   @SWG\Response(response=201, description="Created"),
 *   @SWG\Response(response=400, description="Bad Request"),
 *   @SWG\Response(response=401, description="Unauthorized"),
 *   @SWG\Response(response=404, description="Not Found"),
 *   @SWG\Response(response=405, description="Method Not Allowed"),
 *   @SWG\Response(response=422, description="Unprocessable Entity"),
 *   @SWG\Response(response=500, description="Internal Server Error")
 * )
 *
 */
    public function index()
    {
        $list = Lists::orderBy('id', 'desc')->paginate(50);
        return response()->json($list);
    }
    
/**
 * @SWG\Get(
 *   path="/list/{id}",
 *   summary="List with  id",
 *   operationId="getListWithID",
 *   @SWG\Parameter(
 *     name="id",
 *     in="path",
 *     description="id from list.",
 *     required=true,
 *     type="integer"
 *   ),
 *   @SWG\Response(response=200, description="successful operation"),
 *   @SWG\Response(response=201, description="Created"),
 *   @SWG\Response(response=400, description="Bad Request"),
 *   @SWG\Response(response=401, description="Unauthorized"),
 *   @SWG\Response(response=404, description="Not Found"),
 *   @SWG\Response(response=405, description="Method Not Allowed"),
 *   @SWG\Response(response=422, description="Unprocessable Entity"),
 *   @SWG\Response(response=500, description="Internal Server Error")
 * )
 *
 */
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
