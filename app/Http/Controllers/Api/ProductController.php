<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        
        return  ProductResource::collection(Product::all());

    }


    public function show($id)
    {
        $categorise=Product::find($id);
        if(! $categorise){
            return response()->json([
                "message"=>"Product not found"
            ],404
        );
        }
        return new ProductResource($categorise);
    }



    public function destroy($id)
    {
       $Product= Product::find($id);
        if(!$Product){
            return response()->json([
                "message" => "Product not found"
            ],
            404
        );
        }
        $Product->delete();
        return response()->json([
            "message" => "Product successful delete"
        ]);
    }



    public function store(Request $request)
    {
        $Product = Product::create($request->all());

        return response()->json([
            'message' => 'Product created successfully',
            'Product' => $Product,
        ], 201);
    }

    
    

    public function update(Request $request, $id)
    {  
        $Product= Product::find($id);
        if(!$Product){
            return response()->json([
                "message" => "Product not found"
            ],
            404
        );
        }
        $Product->update($request->all());
        return response()->json([
            "message" => "Product successful update", 
            $Product
        ]);


    }

   
}
