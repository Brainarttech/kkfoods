<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function allUsers(){
        $data=User::where('role','user')->get();
        return view('backend_app.all_users',compact('data'));
    }
    public function submitUser(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password' => 'required|min:6', // You can adjust the minimum length as needed
            'confirm_password' => 'required|same:password', // 'same' rule ensures that it matches the 'password' field
            'address'=>'required',
            'vendor_name'=>'required',
            'type'=>'required',

        ]);
try {
    //code...

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
            'address'=>$request->address,
            'vendor_name'=>$request->vendor_name,
            'phone_no'=>$request->phone_no,
            'type'=>$request->type,
            'zone'=>$request->zone,
            'role'=>"user",
        ]);
        return back()->with('success','New User has been added');
    } catch (\Throwable $th) {
        return back()->with('error','Something went wrong user not added');
    }
    }
    public function editUser($id){
        $data=User::find($id);
        return view('backend_app.update_user',compact('data'));
    }


    public function updateUser(Request $request, $id){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password' => 'required|min:6', // You can adjust the minimum length as needed
            'confirm_password' => 'required|same:password', // 'same' rule ensures that it matches the 'password' field
            'address'=>'required',
            'vendor_name'=>'required',
            'type'=>'required',

        ]);
try {
    //code...
    $data = User::find($id);

    // Check if the user exists
    if (!$data) {
        return back()->with('error', 'User not found');
    }

    // Update user data
    $data->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password ? Hash::make($request->password) : $data->password,
        'address' => $request->address,
        'vendor_name' => $request->vendor_name,
        'phone_no' => $request->phone_no,
        'type' => $request->type,
        'zone' => $request->zone,
        'role' => 'user',
    ]);

    return back()->with('success', 'User information has been updated');
} catch (\Throwable $th) {
    return back()->with('error', 'Something went wrong, user information not updated');
}
}
}
