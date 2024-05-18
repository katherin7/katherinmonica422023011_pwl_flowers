<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Flower;

class FlowerController extends Controller
{
    // Display a listing of the item.
    // *  @return \Illuminate\Http\Response
    public function index()
    {
        return Flower::get();
    }

    /* Store a newly created item in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $flower = new Flower;
            $flower->fill($request->validated())->save();

            return $flower;

        } catch (Exception $exception) {
            throw new HttpException(400, "Invalid data - ($exception->getMessage()}");
        }
    }

    /* Display the specified item.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $flower = Flower::findOrFail($id);
        return $flower;
    }

    // Update the specified item in storage.
    // @param \Illuminate\Http\Request $request
    // @param int $id
    // @return \Illuminate\Http\Response
    public function update(Request $request, $id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }

        try {
            $flower = Flower::find($id);
            $flower->fill($request->validated())->save();
            return $flower;
        } catch (Exception $exception) {
            throw new HttpException(400, "Invalid data ($exception->getMessage()}");
        }
    }

    // Remove the specified item from storage.
    // @param int $id
    // @return \Illuminate\Http\Response
    public function destroy($id)
    {
        $flower = Flower::findOrFail($id);
        $flower->delete();
        return response()->json(null, 204);
    }
}