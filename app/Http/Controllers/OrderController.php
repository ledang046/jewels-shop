<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function getListOrder($id)
    {
        $data = Order::where("customer_id",$id)->orderBy("id","asc")->paginate(10);
        return view('backend.order_history', ["data" => $data]);
    }
    public function showDetailOrder($id)
    {
        $order = Order::find($id);
        $order_detail = DB::table('orders_detail')->where('order_id','=',$id)->get();
        return view('backend.order_detail',['record' => $order,'order_detail' => $order_detail]);
    }
}
