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
     *      )
     * )
     */
    public function index()
    {
        return Flower::get();
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
     *                "florist": "kezia",
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