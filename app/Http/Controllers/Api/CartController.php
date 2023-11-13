<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Auth;
use Illuminate\Http\Response;

class CartController extends Controller
{
    public function ShowCart(){
        if(Auth::guard('api')->check()){
            $user = Auth::guard('api')->user();
            $data = Cart::where('user_id', $user->id)->get();

            $response = [
                'status' => Response::HTTP_OK,
                'result' => 'success',
                'message' => 'Cart data retrieved successfully',
                'data' => [
                    'cart_items' => $data,
                    // Add other response attributes as needed
                ],
            ];

            return response()->json($response, Response::HTTP_OK);
        } else {
            $response = [
                'status' => Response::HTTP_UNAUTHORIZED,
                'result' => 'failure',
                'message' => 'Unauthorized user',
                'data' => null,
            ];

            return response()->json($response, Response::HTTP_UNAUTHORIZED);
        }
        }

    public function AddToCart(Request $request){
        if(Auth::guard('api')->check()){
                $user=Auth::guard('api')->user();
                Cart::create([
                    'product_id'=>$request->product_id,
                    'user_id'=>$user->id,
                    'quantity'=>$request->quantity,
                    'sub_total'=>$request->sub_total,

                ]);
                return response()->json('Your item has been added to cart');
            } {
        return response(['data'=>'unauthorized user'],200);
            }

    }

    public function deleteItem($id) {
        try {
            $cartItem = Cart::find($id);

            if (!$cartItem) {
                $response = [
                    'status' => Response::HTTP_NOT_FOUND,
                    'result' => 'failure',
                    'message' => 'Item not found in the cart',
                    'data' => null,
                ];

                return response()->json($response, Response::HTTP_NOT_FOUND);
            }

            $cartItem->delete();

            $response = [
                'status' => Response::HTTP_OK,
                'result' => 'success',
                'message' => 'Your item has been removed from the cart',
                'data' => null,
            ];

            return response()->json($response, Response::HTTP_OK);
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

}
