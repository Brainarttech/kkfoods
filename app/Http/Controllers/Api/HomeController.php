<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    public function index() {
        try {
            $categories = Category::all();
            $brands = Brand::all();

            $response = [
                'status' => Response::HTTP_OK,
                'result' => 'success',
                'message' => 'Categories and brands retrieved successfully',
                'data' => [
                    'categories' => $categories,
                    'brands' => $brands,
                ],
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

    public function BrandData($slug) {
        try {
            $brand = Brand::where('slug', $slug)->first();

            if (!$brand) {
                $response = [
                    'status' => Response::HTTP_NOT_FOUND,
                    'result' => 'failure',
                    'message' => 'Brand not found',
                    'data' => null,
                ];

                return response()->json($response, Response::HTTP_NOT_FOUND);
            }

            $data = $brand->products;

            $response = [
                'status' => Response::HTTP_OK,
                'result' => 'success',
                'message' => 'Brand data retrieved successfully',
                'data' => $data,
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

    public function CategoryData($slug) {
        try {
            $category = Category::where('slug', $slug)->first();

            if (!$category) {
                $response = [
                    'status' => Response::HTTP_NOT_FOUND,
                    'result' => 'failure',
                    'message' => 'Category not found',
                    'data' => null,
                ];

                return response()->json($response, Response::HTTP_NOT_FOUND);
            }

            $data = $category->products;

            $response = [
                'status' => Response::HTTP_OK,
                'result' => 'success',
                'message' => 'Category data retrieved successfully',
                'data' => $data,
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

    public function AllCategories() {
        try {
            $data = Category::all();

            $response = [
                'status' => Response::HTTP_OK,
                'result' => 'success',
                'message' => 'All categories retrieved successfully',
                'data' => $data,
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

    public function ProductDetail($slug) {
        try {
            $data = Product::where('slug', $slug)->first();

            if (!$data) {
                $response = [
                    'status' => Response::HTTP_NOT_FOUND,
                    'result' => 'failure',
                    'message' => 'Product not found',
                    'data' => null,
                ];

                return response()->json($response, Response::HTTP_NOT_FOUND);
            }

            $response = [
                'status' => Response::HTTP_OK,
                'result' => 'success',
                'message' => 'Product detail retrieved successfully',
                'data' => $data,
            ];

            return response()->json($response, Response::HTTP_OK);
        }
        catch (\Throwable $th) {
            $response = [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'result' => 'failure',
                'message' => $th->getMessage(),
                'data' => null,
            ];

            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function Shop() {
        try {
            $data = Product::with('images')->paginate(20);

            $response = [
                'status' => Response::HTTP_OK,
                'result' => 'success',
                'message' => 'Products in the shop retrieved successfully',
                'data' => $data,
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

    public function allProducts() {
        try {
            $data = Product::all();

            $response = [
                'status' => Response::HTTP_OK,
                'result' => 'success',
                'message' => 'All products retrieved successfully',
                'data' => $data,
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            $response = [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'result' => 'failure',
                'message' => 'Something went wrong',
                'data' => null,
            ];

            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
