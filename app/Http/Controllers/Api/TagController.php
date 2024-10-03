<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        
        return  TagResource::collection(Tag::all());

    }


    public function show($id)
    {
        $tag=Tag::find($id);
        if(! $tag){
            return response()->json([
                "message"=>"Tag not found"
            ],404
        );
        }
        return new TagResource($tag);
    }


    public function destroy($id)
    {
       $Tag= Tag::find($id);
        if(!$Tag){
            return response()->json([
                "message" => "Tag not found"
            ],
            404
        );
        }
        $Tag->delete();
        return response()->json([
            "message" => "Tag successful delete"
        ]);
    }



    public function store(Request $request)
    {
        $Tag = Tag::create($request->all());

        return response()->json([
            'message' => 'Tag created successfully',
            'Tag' => $Tag,
        ], 201);
    }

    
    

    public function update(Request $request, $id)
    {  
        $Tag= Tag::find($id);
        if(!$Tag){
            return response()->json([
                "message" => "Tag not found"
            ],
            404
        );
        }
        $Tag->update($request->all());
        return response()->json([
            "message" => "Tag successful update", 
            $Tag
        ]);


    }

}
