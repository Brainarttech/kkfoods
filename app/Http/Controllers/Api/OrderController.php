<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Models\User;
class OrderController extends Controller
{

    // public function showorders(){
    //     if(Auth::guard('api')->check()){
    //         $user=Auth::guard('api')->user();
    //     $order_data=Order::where('user_id',$user->id);
    //     return response()->json(['order'=>$order_data],200);
    //     }
    //     else{
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }
    // }
    public function OrderSubmit(Request $request){
        $user=User::where('id',$request->user_id)->first();
        try {
                $order= new Order;
                $order->user_id=$user->id;
                $order->total=$request->total;
                $order->bank_status="Not paid";
                $order->delivery_status="pending";
                $order->save();

                if($user->exists()){
                foreach (json_decode($request->products,true) as $item) {
                    $orderitem = new OrderItem;
                    $orderitem->user_id = $user->id;
                    $orderitem->order_id = $order->id;
                    $orderitem->product_id = $item['id'];
                    $orderitem->quantity = $item['quantity'];
                    $orderitem->zone = $user->zone;
                    $orderitem->status = "pending";
                    $orderitem->sub_total = $item['sub_total'];
                    $orderitem->save();
                }

                // Cart::where('user_id', $user->id)->delete();

                $response = [
                    'status' => Response::HTTP_OK,
                    'result' => 'success',
                    'message' => 'Your order has been placed successfully',
                    'data' => null,
                ];

                return response()->json($response, Response::HTTP_OK);
            } else {
                $response = [
                    'status' => Response::HTTP_UNAUTHORIZED,
                    'result' => 'failure',
                    'message' => 'Unauthorized User',
                    'data' => null,
                ];

                return response()->json($response, Response::HTTP_UNAUTHORIZED);
            }
        } catch (\Throwable $th) {
            $response = [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'result' => 'failure',
                'message' => $th->getMessage(),
                'data' => null,
            ];

            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // public function OrderSubmit(Request $request){

    //     $request->validate([
    //         'first_name' => 'required|string|max:255',
    //         'company' => 'nullable|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'phone_no' => 'required|string|max:20',
    //         'address' => 'required|string|max:255',
    //         'appartment' => 'nullable|string|max:255',
    //         'province' => 'required|string|max:255',
    //         'city' => 'required|string|max:255',
    //         'postal_code' => 'required|string|max:20',
    //     ]);

    //     try {


    //      $user=Auth::user();

    //        $data= new Order;
    //        $data->user_id=$user->id;
    //        $data->first_name=$request->first_name;
    //        $data->last_name=$request->last_name;
    //        $data->company_name=$request->company;
    //        $data->email=$request->email ;
    //        $data->phone_no=$request->phone_no;
    //        $data->address=$request->address;
    //        $data->appartment=$request->appartment;
    //        $data->province=$request->province;
    //        $data->city=$request->city;
    //        $data->postal_code=$request->postal_code;


    //        $data->save();

    //        $cart=Cart::where('user_id',$user->id)->get();

    //        foreach ($cart as $item) {
    //         $orderitem=new OrderItem;
    //         $orderitem->order_id=$data->id;
    //         $orderitem->product_id=$item->product_id;

    //         $orderitem->quantity=$item->quantity;
    //         $orderitem->sub_total=$item->sub_total;
    //         $orderitem->status="pending";
    //         $orderitem->save();

    //        }
    //        Cart::where('user_id',$user->id)->delete();
    //        return redirect(route('home'))->with('success','Your order has been placed');
    //     } catch (\Throwable $th) {
    //         return redirect(route('home'))->with('error','Your order cannot be placed');
    //     }


    // }


    public function OrderHistory(Request $request){

        try {
            $user=User::where('id',$request->user_id)->first();
            if($user->exists()){
            $data= Order::where('user_id',$user->id)->get();

            $response = [
                'status' => Response::HTTP_OK,
                'result' => 'success',
                'message' => 'Order history',
                'data' => $data,
            ];
            return response()->json($response, Response::HTTP_OK);
            }
            else {
                $response = [
                    'status' => Response::HTTP_UNAUTHORIZED,
                    'result' => 'failure',
                    'message' => 'You cannot check order history first you should login',
                    'data' => null,
                ];

                return response()->json($response, Response::HTTP_UNAUTHORIZED);
            }
        } catch (\Throwable $th) {
            $response = [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'result' => 'failure',
                'message' => $th->getMessage(),
                'data' => null,
            ];

            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function ordersDetails(Request $request){

        try {
            $user=User::where('id',$request->user_id)->first();
            if($user->exists()){
            $data=OrderItem::with('products')->where('user_id',$user->id)->get();
            $response = [
                'status' => Response::HTTP_OK,
                'result' => 'success',
                'message' => 'Orders Detail',
                'data' => $data,
            ];
            return response()->json($response, Response::HTTP_OK);
            }
            else{
                    $response = [
                        'status' => Response::HTTP_UNAUTHORIZED,
                        'result' => 'failure',
                        'message' => 'You cannot check order history first you should login',
                        'data' => null,
                    ];

                    return response()->json($response, Response::HTTP_UNAUTHORIZED);
            }
        } catch (\Throwable $th) {
            $response = [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'result' => 'failure',
                'message' => $th->getMessage(),
                'data' => null,
            ];

            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }


    }
    public function OrderStatus(Request $request){

        $user=User::where('id',$request->user_id)->first();
        if($user->exists()){
            $data=Order::find($request->order_id);
            $data->delivery_status=$request->status;
            $data->save();
            $response = [
                'status' => Response::HTTP_OK,
                'result' => 'success',
                'message' => 'Order status has been changed',
                'data' => $data,
            ];
            return response()->json($response, Response::HTTP_OK);
    }
    else {
        $response = [
            'status' => Response::HTTP_UNAUTHORIZED,
            'result' => 'failure',
            'message' => 'You cannot check order history first you should login',
            'data' => null,
        ];
        return response()->json($response, Response::HTTP_UNAUTHORIZED);

    }
}
public function allOrderStatus(Request $request) {
    try {
        $user = User::where('id', $request->user_id)->first();
        $pending = OrderItem::where('user_id', $user->id)->where('status', 'pending')->get();
        $delivered = OrderItem::where('user_id', $user->id)->where('status', 'delivered')->get();
        $closed = OrderItem::where('user_id', $user->id)->where('status', 'closed')->get();
        $cancelled = OrderItem::where('user_id', $user->id)->where('status', 'cancelled')->get();

        $response = [
            'status' => Response::HTTP_OK,
            'result' => 'success',
            'message' => 'All Order Status',
            'data' => [
                'pending' => $pending,
                'delivered' => $delivered,
                'closed' => $closed,
                'cancelled' => $cancelled,
            ],
        ];
        return response()->json($response, Response::HTTP_OK);
    } catch (\Throwable $th) {
        $response = [
            'status' => Response::HTTP_UNAUTHORIZED,
            'result' => 'failure',
            'message' => 'unauthorize user',
            'data' => null,
        ];
        return response()->json($response, Response::HTTP_UNAUTHORIZED);
    }
}




}
