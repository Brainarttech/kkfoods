@extends('backend_app.layouts.template')
@section('content')
@php
    $category= App\Models\Category::all();
    $brands= App\Models\Brand::all();
@endphp
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Products</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Add Products
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <form action="{{route('submitproduct')}}" method="POST" enctype="multipart/form-data">
                    @csrf
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                <div class="mb-1 breadcrumb-right">
                    <button class="btn btn-primary" type="submit">Publish</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-9">
        <div class="content-body">
            <!-- Basic Tables start -->
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">


                        <div class="row p-3">
                            <div class="col-12">
                                <label for="">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Name" >
                                @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-12 mt-1">
                                <label for="">Slug <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="slug" placeholder="Slug">
                                @error('slug')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                            <div class="col-6 mt-1">
                                <label for="">Price <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="price" placeholder="Price">
                                @error('price')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                            <div class="col-6 mt-1">
                                <label for="">Sale price</label>
                                <input type="number" class="form-control" name="sale_price" placeholder="Sale Price">
                            </div>
                            <div class="col-12 mt-1">
                                <label for="">Description</label>
                                <textarea  id="" cols="30" rows="10" name="description" class="form-control" placeholder="Enter Description"></textarea>
                            </div>
                            <div class="col-12 mt-1">
                                <label for="">Short Description</label>
                                <textarea id="" cols="30" rows="4" name="excerpt" class="form-control" placeholder="Enter Short Description"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Basic Tables end -->

            <!-- Dark Tables start -->

                        </div>
                    </div>

                    <div class="col-3">
                        <div class="content-body">
                            <!-- Basic Tables start -->
                            <div class="row" id="basic-table">
                                <div class="col-12">
                                    <div class="card">


                                        <div class="row p-2">
                                            <div class="col-12">
                                                <h5>Advance Options</h5>
                                                <label for="" class="mt-1 fw-bold">Featured Image</label>
                                                <input type="file" class="form-control mt-1" name="img">
                                                <label for="" class="mt-1 fw-bold mb-1">Gallery Images</label>
                                                <div class="row">

                                                    <div class="col-md-12">
                                                      <input type="file" multiple name="images[]">




                                                </div>
                                                </div>
                                                </div>
                                                <label for="" class="my-1 fw-bold">Categories</label>
                                                <div class="border rounded-3" style="height: 200px; overflow-y:auto;">
                                                <ul class="list-unstyled  px-1">
                                                    @foreach ($category as $item)
                                                    <div class="form-check mt-1">
                                                        <input class="form-check-input" type="checkbox" name="categories[]" value="{{$item->id}}" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                         {{$item->name}}
                                                        </label>
                                                      </div>
                                                    @endforeach


                                                </ul>
                                            </div>

                                            </div>
                                        </form>

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
            </div>
            <!-- Responsive tables end -->

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

Dropzone.options.myDropzone = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true, // Show remove link on each preview
        init: function () {
            this.on("success", function (file, response) {
                // Handle successful uploads
            });
            this.on("removedfile", function (file) {
                // Handle file removal
            });
        }
    };

</script>
@endsection
