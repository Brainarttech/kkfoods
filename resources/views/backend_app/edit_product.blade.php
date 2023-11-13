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
                        <h2 class="content-header-title float-start mb-0">Update Product</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Products / {{$data->name}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <form action="{{route('updateproduct',['id'=>$data->id])}}" method="POST" enctype="multipart/form-data">
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
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{$data->name}}" >
                                @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-12 mt-1">
                                <label for="">Slug <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="slug" placeholder="Slug"  value="{{$data->slug}}" >
                                @error('slug')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                            <div class="col-6 mt-1">
                                <label for="">Price <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="price" placeholder="Price"  value="{{$data->price}}" >
                                @error('price')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                            <div class="col-6 mt-1">
                                <label for="">Sale price</label>
                                <input type="number" class="form-control" name="sale_price" placeholder="Sale Price"  value="{{$data->sale_price}}" >
                            </div>
                            <div class="col-12 mt-1">
                                <label for="">Description</label>
                                <textarea  id="" cols="30" rows="10" name="description" class="form-control" placeholder="Enter Description">{{$data->description}}</textarea>
                            </div>
                            <div class="col-12 mt-1">
                                <label for="">Short Description</label>
                                <textarea id="" cols="30" rows="4" name="excerpt" class="form-control" placeholder="Enter Short Description">{{$data->excerpt}}</textarea>
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
                                                <img src="{{asset('assets/featured_images/'.$data->img)}}" class="w-100" alt="">
                                                <input type="file" class="form-control mt-1" name="img">
                                                <label for="" class="mt-1 fw-bold mb-1">Gallery Images</label>
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="file" name="images[]" id="images" placeholder="Choose images" multiple >
                                                        </div>
                                                        @error('images')
                                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="mt-1 text-center">
                                                            <div class="images-preview-div "> </div>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="d-flex flex-row flex-nowrap gap-1">

                                                    @foreach ($data->images as $img)
                                                    <div class="w-25 rounded-2 position-relative">
                                                    <img src="{{asset('assets/product_gallery/'.$img->image)}}" width="60" height="50" style="object-fit: cover;" alt="">
                                                    <a href="{{route('delete-img',['id'=>$img->id])}}"><span class="badge text-bg-danger position-absolute top-0">X</span></a>
                                                </div>
                                                    @endforeach



                                                </div>

                                                <label for="" class="my-1 fw-bold">Categories</label>
                                                <div class="border rounded-3" style="height: 200px; overflow-y:auto;">
                                                <ul class="list-unstyled  px-1">
                                                    @foreach ($category as $item)
                                                    <div class="form-check mt-1">
                                                        <input @if($data->categories->contains('id', $item->id)) checked @endif   class="form-check-input" type="checkbox" name="categories[]" value="{{$item->id}}" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                         {{$item->name}}
                                                        </label>
                                                      </div>
                                                    @endforeach


                                                </ul>
                                            </div>
                                            <label for="" class="my-1 fw-bold">Brands</label>
                                            <div class="border rounded-3" style="height: 200px; overflow-y:auto;">
                                                <ul class="list-unstyled  px-1">
                                                    @foreach ($brands as $item)
                                                    <div class="form-check mt-1">
                                                        <input @if($data->brands->contains('id', $item->id)) checked @endif class="form-check-input" type="checkbox" name="brands[]" value="{{$item->id}}" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                         {{$item->name}}
                                                        </label>
                                                      </div>
                                                    @endforeach


                                                </ul>
                                            </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Basic Tables end -->

                            <!-- Dark Tables start -->

                                        </div>
                                    </div>

                    </div></form>
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
 $(function() {
    var previewImages = function(input, imgPreviewPlaceholder) {
        if (input.files) {
            $(imgPreviewPlaceholder).empty(); // Clear existing preview images

            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    var img = $('<img>').attr('src', event.target.result);
                    var imgContainer = $('<div>').addClass('position-relative').append(img);

                    $(imgContainer).appendTo(imgPreviewPlaceholder);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }
    };

    $('#images').on('change', function() {
        previewImages(this, 'div.images-preview-div');
    });

    // Initialize drag and drop sorting functionality
    $('.images-preview-div').sortable({
        containment: 'parent',
        tolerance: 'pointer',
        axis: 'x', // Allow dragging only along the horizontal axis
        update: function(event, ui) {
            // Reorder the images based on the new sorting
            var sortedImages = [];
            $('.images-preview-div img').each(function() {
                sortedImages.push($(this).attr('src'));
            });

            // Clear the preview and re-add images in sorted order
            $('.images-preview-div').empty();
            for (var i = 0; i < sortedImages.length; i++) {
                var img = $('<img>').attr('src', sortedImages[i]);
                var imgContainer = $('<div>').addClass('position-relative').append(img);
                $('.images-preview-div').append(imgContainer);
            }
        }
    }).disableSelection();
});

@endsection
