<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\D111811053_news;
use Illuminate\Support\Facades\Validator;

class D111811053_newsController extends Controller
{
    public function index()
    {
        $D111811053_news = D111811053_news::latest()->get();
        return response()->json([
            'success' => true,
            'message' => 'List Data D111811053_news',
            'data'    => $D111811053_news 
        ], 200);
    }

    public function show($id)
    {
        $D111811053_news = D111811053_news::findOrfail($id);
        return response()->json([
         'success' => true,
         'message' => 'Detail Data D111811053_news',
         'data'    => $D111811053_news
        ], 200);
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title'   => 'required',
            'img_url' => 'required',
            'sub_desc'   => 'required',
            'desc' => 'required',
        ]);
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        //save to database
        $D111811053_news = D111811053_news::create([
            'title' => $request->title,
            'img_url'=> $request->img_url,
            'sub_desc' => $request->sub_desc,
            'desc'=> $request->desc
            
        ]);
        if($D111811053_news) {
            return response()->json([
                'success' => true,
                'message' => 'D111811053_news Created',
                'data' => $D111811053_news
            ], 201);
        } 
    }
    public function update(Request $request, D111811053_news $D111811053_news)
    {
        $validator = Validator::make($request->all(), [
            'title'   => 'required',
            'img_url' => 'required',
            'sub_desc'   => 'required',
            'desc' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $D111811053_news = D111811053_news::findOrFail($D111811053_news->id);
        if($D111811053_news) {
            $D111811053_news->update([
            'title' => $request->title,
            'img_url'=> $request->img_url,
            'sub_desc' => $request->sub_desc,
            'desc'=> $request->desc
            ]);
            return response()->json([
                'success' => true,
                'message' => 'D111811053_news Update',
                'data' => $D111811053_news
            ], 200);
        }
    }
    public function destroy($id)
    {
        $D111811053_news = D111811053_news::findOrFail($id);

        if($D111811053_news) {
            $D111811053_news->delete();
            return response()->json([
                'success' => true,
                'success' => 'D111811053_news Deleted',
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'D111811053_news Not Found',
        ], 404);
    }
}
