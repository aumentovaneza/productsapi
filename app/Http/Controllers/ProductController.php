<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserProductsResource;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Return all products
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProducts(){
        $data = Product::paginate(10);

        return response()->json(['data' => $data, 'success' => true],200);
    }

    /**
     * Return all user product purchases
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserProducts()
    {
        return response()->json(['data' => new UserProductsResource(Auth::user()),
                                'success' => true, 'message' => 'Successfully retrieved user products'],
                    200);
    }

    /**
     * Add products to user's purchases
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postUserProducts(Request $request)
    {
        $skus = $request->product_skus;
        $user = $request->user_id;
        foreach ($skus as $sku){
            Purchase::create([
                'product_sku'  => $sku,
                'user_id'       => $user
            ]);
        }

        return response()->json(['data' => new UserProductsResource(Auth::user()),
            'success' => true, 'message' => 'Successfully retrieved user products'],
            200);
    }

    /**
     * Removes purcheses from user via SKU
     * @param $SKU
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteUserProduct($SKU, Request $request)
    {
        $user = $request->user_id;
        $data = Purchase::where('product_sku', $SKU)->where('user_id', $user)->first();

        if($data){
            $data->delete();

            return response()->json(['data' => new UserProductsResource(Auth::user()),
                'success' => true, 'message' => 'Successfully retrieved user products'],
                200);
        } else {
            return response()->json(['success' => false, 'message' => 'Data not found'], 404);
        }
    }
}
