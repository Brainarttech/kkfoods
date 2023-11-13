<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\Brand;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class OrderController extends Controller
{
    public function allOrders(){
        $data=Order::with('users')->get();
        $zone=Brand::all();
        return view('backend_app.orders',compact('data','zone'));
    }
    public function deleteOrder($id){
        try {
            Order::destroy($id);
            OrderItem::where('order_id',$id)->destroy();
        return back()->with('success','Your order Has been deleted successfully');
        } catch (\Throwable $th) {
          return back()->with('Something went wrong');
        }

    }

    public function updateStatus(Request $request){
        try {

            $data=Order::find($request->id);
            $orderitem=OrderItem::where('order_id',$request->id)->get();
            foreach ($orderitem as $item) {
            $item->status = $request->status;
            $item->save();
            }

            $data->delivery_status=$request->status;
            $data->save();


        return back()->with('success','Your Status has been updated');
        } catch (\Throwable $th) {
          return back()->with('Something went wrong');
        }

    }

    function PendingOrder(){

            $data=OrderItem::with('users','products')->where('status','pending')->get();

            return view('backend_app.pending_order',compact('data'));

    }

    function DeliveredOrder(){

        $data=OrderItem::with('users','products')->where('status','delivered')->get();

        return view('backend_app.delivered_order',compact('data'));

}
function ReturnOrder(){

    $data=OrderItem::with('users','products')->where('status','return')->get();

    return view('backend_app.returned_order',compact('data'));

}

function OrderFilter(Request $request) {
    $query = OrderItem::query(); // Assuming OrderItem is the model you want to query

    if ($request->has('status') && $request->input('status') !== null) {
        $query->where('status', $request->input('status'));
    }

    if ($request->has('zone') && $request->input('zone') !== null) {
        $query->where('zone', $request->input('zone')); // Assuming 'zone_id' is the column name you want to filter on
    }

    if ($request->has('date_from') && $request->has('date_to')) {
        $query->whereBetween('created_at', [$request->input('date_from'), $request->input('date_to')]);
    }

    $data = $query->get();

    $zone=brand::all();

    return view('backend_app.orders', compact('data','zone'));
}

     function Usersummary(){
        try {

           $data=OrderItem::with('products','users')->get();
           $user=User::all();
           $product=Product::all();

           return view('backend_app.user_summary',compact('product','user','data'));
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
    }
    public function SummaryFilter(Request $request) {
        $user = User::all();
        $product = Product::all();

        $query = OrderItem::query();

        if ($request->has('user')) {
            $query->where("user_id", $request->user);
        }

        if ($request->has('product')) {
            $query->where("product_id", $request->product);
        }

        if ($request->has('status')) {
            $query->where("status", $request->status);
        }

        $data = $query->get();

        // Check if the query is empty, and if so, fetch all records


        return view('backend_app.user_summary', compact('data', 'user', 'product'));
    }



    public function OrderDetail($id){
        try {

            $data=OrderItem::with('products','orders')->where('order_id',$id)->get();
            $order_detail=Order::find($id);

            return view('backend_app.order_detail',compact('data','order_detail'));
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }

    }
//     public function printOut(){
// dd("working");
//     }
//
}
