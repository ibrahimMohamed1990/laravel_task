<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Response;
use App\Models\Cats;

class AjaxController extends Controller {
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $cats  =  Cats::where('parent_id', null)->get();
        return view('message')->with(compact('cats'));
    }

    public function data(Request $request)
    {
        $cats = Cats::where('parent_id', $request['cat_id'])->get();; 
        return response()->json($cats);
    }
    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required'
        ]);
        $cats = Cats::create($data);
        return Response::json($cats);
    }
}