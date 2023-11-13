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
                        <h2 class="content-header-title float-start mb-0">Pending Orders</h2>
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
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">


                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>User Name</th>
                                        <th>Status</th>
                                        <th>Quantity</th>
                                        <th>Zone</th>
                                        <th>Functions</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key=>$item)
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td>
                                            <img src="{{asset('assets/featured_images/'.$item->products->img)}}" class="me-75" height="40" width="40" alt="Angular" />
                                            <span class="fw-bold">{{$item->products->name}}</span>
                                        </td>
                                        <td>{{$item->users->name}}</td>

                                        <td>
                                            <form id="statusform" action="{{route('update-status')}}" method="POST" onchange="submitStatus()">
                                            @csrf
                                                <select name="status" class="form-select text-danger fw-bold" id="">
                                                <option @if($item->status === "pending") selected @endif value="pending">Pending</option>
                                                <option @if($item->status === "delivered") selected @endif value="delivered">Delivered</option>
                                                <option @if($item->status === "return") selected @endif value="return">Return</option>
                                            </select>
                                            <input type="hidden"  value="{{$item->id}}" name="id">
                                        </form>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{$item->zone}}</td>



                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                    <i data-feather="more-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">

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
<script>
  function submitStatus() {
        document.getElementById("statusform").submit();
    }
</script>
@endsection
