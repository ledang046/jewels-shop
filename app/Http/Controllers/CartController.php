<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use App\Models\Coupon;
class CartController extends Controller
{
    public function Index(){
        $products = DB::table('products')->get();
        return view('index', compact('products'));
    }

    public function AddCart(Request $req ,$id){
        $product = DB::table('products')->where('id',$id)->first();
        if($product != null){
            $oldCart = Session('Cart') ? Session('Cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->AddCart($product, $id);

            $req->Session()->put('Cart', $newCart);  
        }
        return view('frontend.cart');
    }

    public function DeleteItemCart(Request $req ,$id){
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->DeleteItemCart($id);
        if(Count( $newCart->products) > 0 ){
            $req->Session()->put('Cart', $newCart);
        }
        else{
            $req->Session()->forget('Cart');
        }
        return view('frontend.cart');
    } 
   

    public function ViewListCart(){
        return view('frontend.list');
    }

    public function DeleteListItemCart(Request $req, $id){
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->DeleteItemCart($id);

        if(Count( $newCart->products) > 0 ){
            $req->Session()->put('Cart', $newCart);
        }
        else{
            $req->Session()->forget('Cart');
            $req->Session()->forget('coupon');
        }
        return view('frontend.list-cart');
    }


    public function SaveListItemCart(Request $req, $id, $quanty){
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->UpdateItemCart($id, $quanty);

        $req->Session()->put('Cart', $newCart);
        
        return view('frontend.list-cart');
    }

    public function SaveAllListItemCart(Request $req)
    {
       foreach($req->data as $item){
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->UpdateItemCart($item['key'], $item['value']);
        $req->Session()->put('Cart',$newCart);
       }
    }
    public function Checkout(Request $req)
    {
        if(Auth::check() == false)
        {
            return view('frontend.payment');
        }else
        { 
            $totalprice = Session::get('Cart')->totalPrice;
            $customer_id = Auth::user()->id;
            DB::table('orders')->insert([
            ['customer_id' => $customer_id,'price' => $totalprice, 'date' => Carbon::now()->format('Y-m-d H:i:s'),'status' => '0'],              
            ]);
            $order_id = DB::getPdo('orders')->lastInsertId();
            foreach(Session::get('Cart')->products as $item)
            {
                DB::table('orders_detail')->insert([
                    ['order_id' => $order_id,'product_id' => $item['productInfo']->id, 
                    'quantity' => $item['quanty'], 'price' => $item['price'] 
                     ],              
                    ]);
            }
            $req->Session()->forget('Cart'); 
            $req->Session()->forget('coupon');
            return redirect()->back()->with('successMsg','Checkout successful');
           
        }
    }
    
    public function CartPayment(Request $req)
    {
         $name = $req->input('name');
         $address = $req->input('address');
         $phonenumber = $req->input('phonenumber');
         $email = $req->input('email');
         DB::table('customusers')->insert([
            ['name' => $name,'address' => $address, 'phonenumber' => $phonenumber,'email' => $email,'active' => '1'],              
            ]);
        $totalprice = Session::get('Cart')->totalPrice;
        $customer_id = DB::getPdo('customusers')->lastInsertId();
        DB::table('orders')->insert([
        ['customer_id' => $customer_id,'price' => $totalprice, 'date' => Carbon::now()->format('Y-m-d H:i:s'),'status' => '0'],              
        ]);
        $order_id = DB::getPdo('orders')->lastInsertId();
        foreach(Session::get('Cart')->products as $item)
        {
            DB::table('orders_detail')->insert([
                ['order_id' => $order_id,'product_id' => $item['productInfo']->id, 
                'quantity' => $item['quanty'], 'price' => $item['price'] 
                    ],              
                ]);
        }
        $req->Session()->forget('Cart'); 
        $req->Session()->forget('coupon');
            return redirect()->back()->with('successMsg','Payment successful');
    }

    public function CheckCoupon(Request $request)
    {
        $data = $request->all();
        $coupon = Coupon::where('code',$data['coupon'])->first();
        if($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon > 0){
                $coupon_session = Session::get('coupon');
                if($coupon_session == true){
                    $is_available = 0;
                    if($is_available == 0){
                        $cou[] = array(
                            'code' => $coupon->code,
                            'condition' => $coupon->condition,
                            'number' => $coupon->number,
                        );
                        Session::put('coupon',$cou);
                    }
                }else{
                    $cou[] = array(
                        'code' => $coupon->code,
                        'condition' => $coupon->condition,
                        'number' => $coupon->number,
                    );
                    Session::put('coupon',$cou);
                }
                Session::save();

                return redirect()->back()->with('successMsg','Add coupon succsess.',['coupon' => $coupon]);
            }
        }
        else{
            return redirect()->back()->with('errorMsg','Coupon incorrect.');
        }
    }
   
}
