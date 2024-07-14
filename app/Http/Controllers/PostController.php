<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts= DB::table('posts')->get();
        return response()->json($posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        try {
            //en attendant que l'authentification soit ok
            $data = $request->all();
            $data['user_id'] = 1;
            $post = DB::table('posts')->insert($data);
            return response()->json($post,201);
        } catch (\Throwable $th) {

            return response()->json($th,500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try {
            //code...
            $post = DB::table('posts')->find($id);
            return response()->json($post);
        } catch (\Throwable $th) {

            return response()->json($th,500);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        try {
            //code...
            $post = DB::table('posts')->find($id);
            return response()->json($post);
        } catch (\Throwable $th) {

            return response()->json($th,500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            //code...
            $post = DB::table('posts')->where('id',$id)->update($request->all());
            return response()->json($post,201);
        } catch (\Throwable $th) {

            return response()->json($th,500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            //code...
            $post = DB::table('posts')->where('id',$id)->delete();
            return response()->json($post,201);
        } catch (\Throwable $th) {

            return response()->json($th,500);
        }
    }
}
