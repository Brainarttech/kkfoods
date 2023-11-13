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
                        <h2 class="content-header-title float-start mb-0">Orders</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Orders
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
            <div class="pt-2   bg-white rounded-3 border">
                <div class="container-fluid">
                    <h6 class="mb-2">Search Order</h6>
                    <form action="{{route('order-filter')}}" method="post">
                    <div class="row px-2 ">

                                @csrf
                        <div class="col-md-3 col-lg-3">
                            <label for="">Status</label>

                            <select  name="status" class="form-select" >
                               <option value="">Select Status</option>

                               <option value="delivered">Delivered</option>
                               <option value="pending">Pending</option>
                               <option value="cancel">Cancel</option>




                            </select>
                        </div>
                         <div class="col-md-3 col-lg-3">
                            <label for="">Zone</label>

                            <select  name="zone" class="form-select" >
                               <option value="">Select Zone</option>

                             @forelse ($zone as $item)
                               <option value="{{$item->id}}">{{$item->name}}</option>
                             @empty

                             @endforelse


                            </select>
                        </div>
                        <div class="col-md-3 col-lg-3">
                            <label for="">Date From</label>
                            <input type="date" name="date_from" placeholder="Enter Your Network" class="form-control">
                        </div>
                        <div class="col-md-3 col-lg-3">
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
                <div class="col-12">
                    <div class="card">


                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Order-ID</th>
                                        <th>Name</th>
                                        <th>Bank Status</th>
                                        <th>Delivery Status</th>
                                        <th>Total</th>
                                        <th>Created AT</th>
                                        <th>Functions</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key=>$item)
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td>
                                            {{-- <img src="{{asset('assets/featured_images/'.$item->products->img)}}" class="me-75" height="40" width="40" alt="Angular" /> --}}
                                            <span class="fw-bold">Order:ID-{{$item->id}}</span>
                                        </td>
                                        <td>{{$item->users->name}}</td>
                                        <td>{{$item->bank_status}}</td>

                                        <td>
                                            <form  id="statusform" action="{{route('update-status')}}" method="POST" class="status_form">
                                            @csrf
                                                <select name="status" class="form-select @if($item->delivery_status === "pending") text-warning @endif @if($item->delivery_status === "delivered") text-success @endif @if($item->delivery_status === "cancelled") text-danger @endif @if($item->delivery_status === "return") text-info  @endif  fw-bold" id="">

                                                <option @if($item->delivery_status === "pending") selected @endif value="pending">Pending</option>
                                                <option @if($item->delivery_status === "delivered") selected @endif value="delivered">Delivered</option>
                                                <option @if($item->delivery_status === "cancelled") selected @endif value="cancelled">Cancelled</option>
                                                <option @if($item->delivery_status === "return") selected @endif value="return">Return</option>
                                            </select>
                                            <input type="hidden"  value="{{$item->id}}" name="id">
                                        </form>
                                        <td>{{$item->total}}</td>
                                        <td>{{$item->created_at}}</td>



                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                    <i data-feather="more-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="{{route('order-detail',['id'=>$item->id])}}">
                                                        <i data-feather="edit" class="me-50"></i>
                                                        <span>View More Detail</span>
                                                    </a>
                                                    <a class="dropdown-item" href="{{route('deleteOrder',['id'=>$item->id])}}">
                                                        <i data-feather="trash" class="me-50"></i>
                                                        <span>Delete</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach



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
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>

$(".status_form select").change(function() {
            $(this).closest(".status_form").submit();
        });
    $(document).ready(function() {

        $(".tab-link").click(function() {
            $(".tab-link").removeClass("active"); // Remove active class from all tabs
            $(this).addClass("active"); // Add active class to the clicked tab

            var tab = $(this).data("tab");
            $(".tab-content").hide();
            $("#" + tab).show();
        });

        // Handle tab switching
    });
</script>
@endsection
