<?php

namespace App\Http\Controllers;

use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return response()->json(['status_response'=>'ok','code_response'=>200,'count_result'=>$products->count(),'data'=>$products], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reglas = ['code'=>'required|string|min:1|max:10|unique:products,code,'.$request->code, 'description'=>'required|min:1|max:500'];
        $valid = Validator::make($request->all(), $reglas);
        if ($valid->fails()) { return response()->json(['status_response'=>'error','code_response'=>400, 'data'=>$valid->errors()], 400 ); }

        $product              = new Product();
        $product->code        = $request->code;
        $product->description = $request->description;
        $product->save();

        return response()->json(['status_response'=>'ok','code_response'=>200,'count_result'=>1,'data'=>$product], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json(['status_response'=>'ok','code_response'=>200,'count_result'=>1,'data'=>$product], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $reglas = ['code'=>'required|string|min:1|max:10|unique:products,code,'.$request->code, 'description'=>'required|min:1|max:500'];
        $valid = Validator::make($request->all(), $reglas);
        if ($valid->fails()) { return response()->json(['status_response'=>'error','code_response'=>400, 'data'=>$valid->errors()], 400 ); }

        $product->code        = $request->code;
        $product->description = $request->description;
        $product->save();

        return response()->json(['status_response'=>'ok','code_response'=>200,'count_result'=>1,'data'=>$product]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['status_response'=>'ok','code_response'=>200,'count_result'=>1,'data'=>$product]);
    }
}
