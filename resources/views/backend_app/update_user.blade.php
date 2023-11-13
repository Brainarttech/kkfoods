@extends('backend_app.layouts.template')
@php
    $brand=App\Models\Brand::all();
@endphp
@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">User</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                </li>
                                </li>
                                <li class="breadcrumb-item active">Update User
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <form action="{{route('update-user',['id'=>$data->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
            </div>


            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                <div class="mb-1 breadcrumb-right">
                   <button class="btn btn-primary " type="submit">Update</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
        <div class="content-body">
            <!-- Basic Tables start -->
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">


                        <div class="row p-3">
                            <div class="col-12">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{$data->name}}">
                                @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-12 mt-1">
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Enter Distributor Email" value="{{$data->email}}">
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                            <div class="col-6 mt-1">
                                <label for="">New Password</label>
                                <input type="text" class="form-control" name="password" placeholder="Enter Password" >
                                @error('password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div> <div class="col-6 mt-1">
                                <label for="">Confirm Password</label>
                                <input type="text" class="form-control" name="confirm_password" placeholder="Enter Confirm Password">
                                @error('confirm_password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>

                            <div class="col-6 mt-1">
                                <label for="">Address</label>
                                <input type="text" class="form-control" name="address" placeholder="Enter Distributor Address" value="{{$data->address}}">
                                @error('address')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>

                            <div class="col-6 mt-1">
                                <label for="">Vendor_name</label>
                                <input type="text" class="form-control" name="vendor_name" placeholder="Enter Vendor Name" value="{{$data->vendor_name}}">

                            </div>

                            <div class="col-6 mt-1">
                                <label for="">Type</label>
                               <select name="type" class="form-select" id="">
                                <option value="">Select Type Of User</option>
                                <option @if($data->type==='distributor') selected @endif value="distributor">Distributor</option>
                                <option @if($data->type==='sales_representative') selected @endif value="sales_representative">Sales Representative</option>

                               </select>
                            </div>
                            <div class="col-6 mt-1">
                                <label for="">Zone</label>
                               <select name="zone" class="form-select" id="">
                                <option value="">Select Zone</option>
                                @foreach ($brand as $item)
                                <option @if($data->zone === $item->name) selected @endif value="{{$item->name}}">{{$item->name}}</option>
                                @endforeach
                               </select>
                            </div>
                            <div class="col-6 mt-1">
                                <label for="">Phone no</label>
                                <input type="text" class="form-control" name="phone_no" placeholder="Enter Phone number" value="{{$data->phone_no}}">

                            </div>



                        </div>
                    </div>
                </div>
            </div>
            <!-- Basic Tables end -->

            <!-- Dark Tables start -->

                        </div>
                    </div>


                    </div>
                </div>
            </div>
            <!-- Responsive tables end -->

        </div>
    </div>
</div>


@endsection
