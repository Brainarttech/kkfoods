<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Brand;
use App\Models\HomeSlider;
use Illuminate\Http\Request;
use Auth;
use App\Models\Order;
use App\Models\User;
use App\Models\Category;



class HomeController extends Controller
{
    public function index(){
        try {
            $categories=Category::all();
            $brands=Brand::all();
            return view('front-app.index',compact('categories','brands'));
        } catch (\Throwable $th) {
           return view('front-app.404');
        }

    }

    public function BrandData($slug){

            $databrand=Brand::where('slug',$slug)->first();
            $data=$databrand->Products;

            return view('front-app.shop',compact('data'));


    }

    public function CategoryData($slug){


            $datacategory=Category::where('slug',$slug)->first();
            $data=$datacategory->products;

            return view('front-app.shop',compact('data'));
        }


    public function ProductDetail($slug){
        try{
           $data=Product::where('slug',$slug)->first();

           return view('front-app.product_detail',compact('data'));
        } catch (\Throwable $th) {
            return back()->with('Something Went Wrong');
        }
    }

    public function Shop(){
        $data=Product::paginate(18);
        return view('front-app.shop',compact('data'));
    }

    public function DashboardData(){

        $products=Product::all()->count();
        $users=User::all()->count();
        $orders = Order::where('delivery_status', 'delivered')->count();
        $pendingOrders = Order::where('delivery_status', 'pending')->count();

        if ($pendingOrders > 0) {
            $percentageDelivered = ($orders / $pendingOrders) * 100;
        } else {
            $percentageDelivered = 0; // Avoid division by zero
        }

        // Format the result
        $percentageDelivered = number_format($percentageDelivered, 2);

        $allorders=Order::all()->count();
        $startDate = now()->startOfMonth(); // Start of the current month
    $endDate = now()->endOfMonth();     // End of the current month

    $monthearning = Order::whereBetween('created_at', [$startDate, $endDate])
        ->sum('total');

        $currentMonthEarnings = Order::whereBetween('created_at', [$startDate, $endDate])
        ->sum('total');

    // Calculate the total earnings for the previous month
    $previousMonthStartDate = $startDate->subMonth();
    $previousMonthEndDate = $endDate->subMonth();
    $previousMonthEarnings = Order::whereBetween('created_at', [$previousMonthStartDate, $previousMonthEndDate])
        ->sum('total');

    // Calculate the percentage increase
    $percentageIncrease = 0;

    if ($previousMonthEarnings > 0) {
        $percentageIncrease = (($currentMonthEarnings - $previousMonthEarnings) / $previousMonthEarnings) * 100;
    }

    // Format the results
    $currentMonthEarnings = number_format($currentMonthEarnings, 2);
    $percentageIncrease = number_format($percentageIncrease, 2);

    $overallsum=Order::sum('total');
    $ordersdata=Order::with('users')->get();
    $categories=Brand::all()->count();
    return view('backend_app.index', compact('products','users','orders','categories','allorders','monthearning','currentMonthEarnings','percentageIncrease','pendingOrders','percentageDelivered','overallsum','ordersdata'));
    
    }


}
