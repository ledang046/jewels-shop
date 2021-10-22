<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Comment;

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

    public function loadComment(Request $request)
    {
        $product_id = $request->product_id;
        $comment = Comment::where("product_id",$product_id)->where('display',1)->where('reply_comment_id',"=",null)->get();
        $replys = Comment::where("reply_comment_id",">",0)->get();
        $output = '';
        foreach($comment as $key => $comm)
        {
            $output.= ' 
            <div class="be-comment">
            <div class="be-img-comment">	
                <a href="blog-detail-2.html">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="be-ava-comment">
                </a>
            </div>
            <div class="be-comment-content">
                
                    <span class="be-comment-name">
                        <a href="blog-detail-2.html">'. $comm->name .'</a>
                        </span>
                    <span class="be-comment-time">
                        <i class="fa fa-clock-o"></i>
                        '. $comm->date .'
                    </span>

                <p class="be-comment-text">
                    '. $comm->comment .'
                </p>
            </div>
           </div>
            ';
            // Admin
            foreach($replys as $key  => $rep){
                if($rep->reply_comment_id == $comm->id){
                    $output.= '
                    <div style="width:80%;margin-left:30px;" class="be-comment">
                    <div class="be-img-comment">	
                        <a href="blog-detail-2.html">
                            <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="" class="be-ava-comment">
                        </a>
                    </div>
                    <div class="be-comment-content">
                        
                            <span class="be-comment-name">
                                <a href="blog-detail-2.html">Admin</a>
                                </span>
                            <span class="be-comment-time">
                                <i class="fa fa-clock-o"></i>
                                '. $rep->date .'
                            </span>
        
                        <ps class="be-comment-text">
                        '. $rep->comment .'
                        </p>
                    </div>
                   </div>
                    ';
                }
            }
            //End Admin 
        }
        echo $output;
    }

    public function sendComment(Request $request)
    {
        $cmt = new Comment();
        $cmt->comment = $request->comment;
        $cmt->name = $request->name;
        $cmt->product_id = $request->product_id;
        $cmt->save();

    }

}
