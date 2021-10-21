<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserProductsResource;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function getProducts(){
        $data = Product::paginate(10);

        return response()->json(['data' => $data, 'success' => true],200);
    }

    public function getUserProducts()
    {
        return response()->json(['data' => new UserProductsResource(Auth::user()),
                                'success' => true, 'message' => 'Successfully retrieved user products'],
                    200);
    }

    public function postUserProducts(Request $request)
    {
        $skus = $request->product_skus;

        foreach ($skus as $sku){
            Purchase::create([
                'product_sku'  => $sku,
                'user_id'       => Auth::user()->id
            ]);
        }

        return response()->json(['data' => new UserProductsResource(Auth::user()),
            'success' => true, 'message' => 'Successfully retrieved user products'],
            200);
    }

    public function deleteUserProduct($SKU)
    {
        $data = Purchase::where('product_sku', $SKU)->where('user_id', Auth::user()->id)->first();

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
