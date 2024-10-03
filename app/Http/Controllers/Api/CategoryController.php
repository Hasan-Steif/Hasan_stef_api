<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        
        
        return  CategoryResource::collection(Category::all());

    }


    public function show($id)
    {
        $categorise=Category::find($id);
        if(! $categorise){
            return response()->json([
                "message"=>"Category not found"
            ],404
        );
        }
        return new CategoryResource($categorise);
    }



    public function destroy($id)
    {
       $category= Category::find($id);
        if(!$category){
            return response()->json([
                "message" => "Category not found"
            ],
            404
        );
        }
        $category->delete();
        return response()->json([
            "message" => "Category successful delete"
        ]);
    }



    public function store(Request $request)
    {
        $category = Category::create($request->all());

    return response()->json([
        'message' => 'Category created successfully',
        'category' => $category,
    ], 201);
    }

    
    

    public function update(Request $request, $id)
    {  
        $category= Category::find($id);
        if(!$category){
            return response()->json([
                "message" => "Category not found"
            ],
            404
        );
        }
        $category->update($request->all());
        return response()->json([
            "message" => "Category successful update", 
            $category
        ]);


    }

   
}
