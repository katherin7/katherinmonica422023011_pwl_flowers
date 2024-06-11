<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Flower;
use OpenApi\Annotations as OA;

/**
 * Class Flowercontroller.
 * @author Katherin <katherin.422023011@civitas.ukrida.ac.id>
 */

class FlowerController extends Controller
{
    /**
     * @OA\Get (
     *      path="/api/flower",
     *      tags={"flower"},
     *      summary="Display a listing of items",
     *      operationId="index",
     *      @OA\Response(
     *          response=200,
     *          description="successful",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Parameter( 
     *          name="_page", 
     *          in="query",
     *          description="current page", 
     *          required=true,
     *          @OA\Schema(
     *          type="integer",
     *          format="int64",
     *          example=1
     *      )
     * ),
     *      @OA\Parameter(
     *          name="_limit",
     *          in="query",
     *          description="max item in a page", 
     *          required=true,
     *          @OA\Schema(
     *          type="integer", 
     *          format="int64",
     *          example=10
     *      )
     * ),
     *      @OA\Parameter(
     *          name="_search",
     *          in="query",
     *          description="word to search",
     *          required=false,
     *          @OA\Schema(
     *          type="string",
     *      )
     * ),
     *      @OA\Parameter(
     *          name="_florist",
     *          in="query",
     *          description="search by florist like name",
     *          required=false, 
     *          @OA\Schema(
     *          type="string",
     *      )
     * ),
     *      @OA\Parameter(
     *          name="_sort_by",
     *          in="query",
     *          description="word to search",
     *          required=false,
     *          @OA\Schema(
     *          type="string", 
     *          example="latest"
     *          )
     *      ),
     * )
     */
    
    public function index(Request $request)
    {
        try {
            $data['filter']     = $request->all();
            $page               = $data['filter']['_page'] = (@$data['filter']['_page'] ? intval($data['filter']['_page']): 1); 
            $limit              = $data['filter']['_limit'] = (@$data['filter']['_limit'] ? intval($data['filter']['_limit']) : 1000); 
            $offset             = ($page?($page-1)*$limit:0);
            $data['products']   = Flower::whereRaw('1 = 1');
            
            if($request->get('_search')){
                $data['products'] = $data['products']->whereRaw('(LOWER(flowers) LIKE "%'.strtolower($request->get('_search')).'%" OR LOWER (florist) LIKE "%'.strtolower($request->get('_search')).'%")');
            }
            if($request->get('_florist')){
                $data['products'] = $data['products']->whereRaw('LOWER(florist) = "'.strtolower($request->get('_florist')).'"');
            }
            if($request->get('_sort_by')){
            switch ($request->get('_sort_by')) {
                default:
                case 'latest_added':
                $data['products'] = $data['products']->orderBy('created_at','DESC');
                break;
                case 'jenis_bunga_asc':
                $data['products'] = $data['products']->orderBy('jenis_bunga', 'ASC');
                break;
                case 'jenis_bunga_desc':
                $data['products'] = $data["products"]->orderBy('jenis_bunga', 'DESC');
                break;
                case 'price_asc':
                $data['products'] = $data['products']->orderBy('price','ASC');
                break;
                case 'price_desc':
                $data['products'] = $data['products']->orderBy('price','DESC');
                break;
            }
        }
        $data['products_count_total'] = $data['products']->count();
        $data['products']             = ($limit==0 && $offset==0)?$data['products']:$data['products']->limit($limit)->offset($offset); 
        // $data['products_raw_sql']  - $data['products']->tosql();
        $data['products']             = $data['products']->get();
        $data['products_count_start'] = ($data['products_count_total'] == 0 ? 0 : (($page-1)*$limit)+1);
        $data['products_count_end']   = ($data['products_count_total'] == 0 ? 0 : (($page-1)*$limit)+sizeof($data['products']));
        return response()->json($data, 200);

    } catch(\Exception $exception) {
        throw new HttpException(400, "Invalid data: {$exception->getMessage()}");
    }
}
    /**
     * @OA\Post(
     *    path="/api/flower",
     *    tags={"flower"},
     *    summary="Store a newly created item",
     *    operationId="store",
     *    @OA\Response(
     *        response=400,
     *        description="Invalid Input",
     *        @OA\JsonContent()
     *    ),
     *    @OA\Response(
     *        response=201,
     *        description="Successful",
     *        @OA\JsonContent()
     *    ),
     *    @OA\RequestBody(
     *        required=true,
     *        description="Request body description",
     *        @OA\JsonContent(
     *            ref="#/components/schemas/Flower",
     *            example={
     *                "id" : 5,
     *                "jenis_bunga": "Tulip", 
     *                "florist": "IM NAYEON",
     *                "price": 85000, 
     *                "description": "With flower we can know what they want to tell without really speakup",
     *                "image":"https://www.bing.com/th?id=OIP.wlOURUeyYHKMa1xzVmRQxwHaHa&w=206&h=206&c=8&rs=1&qlt=90&o=6&dpr=1.1&pid=3.1&rm=2",
     *              }
     *        ),
     *    ),
     *          security={{"passport_token_ready":{}, "passport":{}}}
     * )
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(),[
                'jenis_bunga' => 'required|unique:flowers',
                'florist' => 'required|max:100',
            ]);
            if ($validator->fails()){
                throw new HttpException(400, $validator->messages()->first());
            }
            $flower = new Flower;
            $flower->fill($request->all())->save();
            return $flower;

        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data : {$exception->getMessage()}");
        }
    }

    /**
     * @OA\Get(
     *     path="/api/flower/{id}",
     *     tags={"flower"},
     *     summary="Display the specified item",
     *     operationId="show",
     *     @OA\Response(
     *         response=404,
     *         description="Item not found",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *          response=400,
     *          description="Invalid input",
     *          @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent()
     *     ),
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of item that needs to be displayed",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *     ),
     * )
     */
    public function show($id)
    {
        $flower = Flower::find($id);
        if (!$flower) {
            throw new HttpException(404, 'Item not found');
        }
        return $flower;
    }

    /**
     * @OA\Put(
     *     path="/api/flower/{id}",
     *     tags={"flower"},
     *     summary="Update the specified item",
     *     operationId="update",
     *     @OA\Response(
     *         response=404,
     *         description="item not found",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *          response=400,
     *          description="Invalid input",
     *          @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent()
     *     ),
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of item that needs to be updated",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *     ),
     *     @OA\RequestBody(
     *        required=true,
     *        description="Request body description",
     *        @OA\JsonContent(
     *            ref="#/components/schemas/Flower",
     *            example={
     *                "id":5,
     *                "jenis_bunga": "Tulip", 
     *                "florist": "kezia",
     *                "price": 85000, 
     *                "description": "With flower we can know what they want to tell without really speakup",
     *                "image":"https://th.bing.com/th/id/OIP.7pUhm2B52MhYIWgN1AWTGAHaHY?rs=1&pid=ImgDetMain",
     *            }
     *        ),
     *     ),
     *      security={{"passport_token_ready":{}, "passport":{}}}
     * )
     *  
     */
    public function update(Request $request, $id)
    {
        $flower = Flower::find($id);
        if (!$flower) {
            throw new HttpException(404, "Item not found");
        }

        try {
            $validator = Validator::make($request->all(), [
                'jenis_bunga' => 'required|unique:flowers',
                'florist' => 'required|max:100',
            ]);
            if ($validator->fails()) {
                throw new HttpException(400, $validator->messages()->first());
            }
            $flower->fill($request->all())->save();
            return response()->json(array('message' => 'Updated successfully :)'), 200);
        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data : {$exception->getMessage()})");
        }
    }

    /**
     * @OA\Delete(
     *      path="/api/flower/{id}",
     *      tags={"flower"},
     *      summary="Remove the specified item",
     *      operationId="destroy",
     *      @OA\Response(
     *          response=404,
     *          description="Item not found",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Invalid input",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of item that needs to be removed",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *          security={{"passport_token_ready":{}, "passport":{}}}
     * )
     */
    public function destroy($id)
    {
        $flower = Flower::find($id);
        if (!$flower) {
            throw new HttpException(404, 'Item not found');
        }

        try {
            $flower->delete();
            return response()->json(array('message' => 'congrats your delete is done'), 200);
        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data: {$exception->getMessage()}");
        }
    }
}