<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Rating;

class ProductController extends Controller
{
    public function getAllProd()
    {
        $data = Product::orderBy("id","asc")->get();
        return view('frontend.index')->with(['data' => $data]);
    }
    public function showProdDetail($id)
    {
        $record = Product::where("id",$id)->first();
        $rating = Rating::where("product_id",$id)->avg('star');
        $rating = round($rating);
        return view('frontend.product-detail')->with(['record' => $record,'rating' => $rating]);
    }
    public function insertRating(Request $request)
    {
        $data = $request->all();
        $rating = new Rating();
        $rating->product_id =  $data['product_id'];
        $rating->star = $data['index'];
        $rating->save();
        echo 'done';
    }
}
