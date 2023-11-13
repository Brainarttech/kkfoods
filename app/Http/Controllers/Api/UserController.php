<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Http\Response;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function loginUser(Request $request)
    {
        $credentials = $request->all();

        try {
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('token')->accessToken;
                $response = [
                    'status' => Response::HTTP_OK,
                    'result' => 'success',
                    'user_id' => $user->id,
                    'data' => null,
                ];

                return response()->json($response, Response::HTTP_OK);
            } else {
                $response = [
                    'status' => Response::HTTP_UNAUTHORIZED,
                    'result' => 'failure',
                    'message' => 'Unauthorized',
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

    public function getUserDetails()
    {
        try {

            if (Auth::guard('api')->check()) {
                $user = Auth::guard('api')->user();

                $response = [
                    'status' => Response::HTTP_OK,
                    'result' => 'success',
                    'data' => $user,
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

    public function userLogout()
    {
        try {
            if (Auth::guard('api')->check()) {
                $accessToken = Auth::guard('api')->user()->token();
                \DB::table('oauth_refresh_tokens')->where('access_token_id', $accessToken->id)->update(['revoked' => true]);
                $accessToken->revoke();

                $response = [
                    'status' => Response::HTTP_OK,
                    'result' => 'success',
                    'message' => 'User Logout',
                    'data' => null,
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
