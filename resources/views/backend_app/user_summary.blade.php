@extends('backend_app.layouts.template')
@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Summary</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active">All Users Summary
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                <div class="mb-1 breadcrumb-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="app-todo.html"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="me-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="me-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="me-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic Tables start -->
            <div class="pt-2   bg-white rounded-3 border mb-1">
                <div class="container-fluid">
                    <h6 class="mb-2">Search</h6>
                    <form action="{{route('summary-filter')}}" method="post">
                    <div class="row px-2 ">

                                @csrf
                        <div class="col-md-2 col-lg-2">
                            <label for="">Users</label>

                            <select  name="user" class="form-select" >
                                <option disabled selected value="">Select User</option>

                                @forelse ($user as $item)
                                <option value="{{$item->id}}" >{{$item->name}}</option>
                                @empty

                               <option value="">Empty</option>
                                @endforelse


                            </select>
                        </div>
                         <div class="col-md-2 col-lg-2">
                            <label for="">Products</label>

                            <select  name="product" class="form-select" >
                                <option disabled selected value="">Select Products</option>
                                @forelse ($product as $item)

                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @empty

                               <option value="">Empty</option>
                                @endforelse


                            </select>
                        </div>
                        <div class="col-md-2 col-lg-2">
                            <label for="">Status</label>
                            <select  name="status" class="form-select" >
                                <option disabled selected value="">Select Status</option>
                               <option value="delivered">Delivered</option>
                               <option value="pending">Pending</option>
                               <option value="return">Return</option>
                               <option value="cancelled">Cancelled</option>

                            </select>
                        </div>
                        <div class="col-md-2 col-lg-2">
                            <label for="">Date From</label>
                            <input type="date" name="date_from" placeholder="Enter Your Network" class="form-control">
                        </div>
                        <div class="col-md-2 col-lg-2">
                            <label for="">Date To</label>
                            <input type="date" name="date_to" placeholder="Enter Your Network" class="form-control">
                        </div>

                        <div class="col-md-12 col-lg-12">
                            <button class="btn btn-primary my-3 float-end" type="submit">Search</button>
                        </div>
                    </form>
                    </div>

                </div>
            </div>


            <div class="row" id="basic-table">
            <button class="btn btn-primary my-2 ms-auto d-block" style="width: 10%;" onclick="printArea('printThis');" Value="Print"><div data-feather="printer"></div> Print</button>
                <div class="col-12">
                    <div class="card">

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                       <th>User Name</th>
                                       <th>Product</th>
                                       <th>Quantity</th>
                                       <th>Zone</th>
                                       <th>Status</th>

                                       <th>Date</th>
                                       <th>Time</th>
                                    </tr>



                                    @foreach ($data as $key=>$item)
                                    <tr>
                                    <td>{{$key}}</td>
                                        <td>{{$item->users->name}}</td>
                                        <td>{{$item->products->name}}   </td>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{$item->users->zone}}</td>
                                        <td ><span class="badge rounded-pill @if($item->status==="delivered") badge-light-success  @endif @if($item->status==="pending") badge-light-warning  @endif @if($item->status==="cancelled") badge-light-danger  @endif @if($item->status==="return") badge-light-info  @endif me-1">{{$item->status}}</span></td>
                                        <td>{{$item->created_at->format('M D Y') }}</td>
                                        <td>{{$item->created_at->format('h:i:s') }}</td>
                                    </tr>
                                    @endforeach




                                </thead>
                                <tbody>




                                </tbody>
                            </table>
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
            <!-- Responsive tables end -->

        </div>
    </div>
</div>
<div id="printThis" style="display: none;">
    <div class="container-fluid" >
        <img src="{{asset('assets/kkfoodlogo.png')}}" width="150" height="150" class=" ms-auto d-block mb-4"  alt="">
        <h2 class="fw-bold mb-3 text-decoration-underline">Order Summary</h2>
    <table class="table">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Username</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Zone</th>
                <th>Status</th>
                <th>Date</th>
                <th>Time</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key=>$item)
            <tr>
            <td>{{$key}}</td>
                <td>{{$item->users->name}}</td>
                <td>{{$item->products->name}}   </td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->users->zone}}</td>
                <td>{{$item->orders->delivery_status}}</td>

                <td>{{$item->created_at->format('M Y d') }}</td>
                <td>{{$item->created_at->format('h:i:s') }}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
    @php
        $currentDateTime = date('Y-m-d H:i:s', time());
    @endphp
    <h6 class="position-absolute bottom-0 end-0">{{$currentDateTime}}</h6>
</div>
</div>
<script>
     function printArea(areaName)
    {
        var printContents = document.getElementById(areaName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
  function submitStatus() {
        document.getElementById("statusform").submit();
    }
</script>
@endsection
