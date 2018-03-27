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
use App\Http\Controllers\ResponseAPI;
use App\Http\Requests;



class ListController extends Controller
{
    protected $response;
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
 
    public function __construct() {
        $this->response = new ResponseAPI();
    }
    
    public function index()
    {
        $list = Lists::orderBy('id', 'desc')->paginate(50);
        if ($list) {
            return $this->response->res($list, 200);
        } else {
        return $this->response->res([], 404, 'Record not found');
        }
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
        if ($list) {
            return $this->response->res($list, 200);
        } else {
            return $this->response->res([], 404, 'Record not found');
        }
    }

/**
* @SWG\Post(
*   path="/list",
*   summary="List with  id",
*   operationId="getListPostID",
*   @SWG\Parameter(
*    name="body",
*    in="body",
*    required=true,
*     @SWG\Schema(
*       required={"name", "status"},
*       @SWG\Property(
*         property="name",
*         type="string",
*         maximum=64
*       ),
*       @SWG\Property(
*         property="status",
*         type="string",
*         enum={"A", "I"},
*         default="A",
*       ),
*     )
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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:lists|max:255'
        ]);
        if ($validator->fails()) {
            return $this->response->res([], 400, $validator);
        }
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
