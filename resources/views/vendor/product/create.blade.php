@extends('vendor.layouts.master')

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Create Product</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group wsus__input">
                                        <label>Image</label>
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group wsus__input">
                                                <label>Category</label>
                                                <select class="form-control main-category" name="category" >
                                                    <option value="">Select...</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group wsus__input">
                                                <label>Sub Category</label>
                                                <select class="form-control sub-category" name="sub_category" >
                                                    <option value="">Select...</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group wsus__input">
                                                <label>Child Category</label>
                                                <select class="form-control child-category" name="child_category" >
                                                    <option value="">Select...</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>Brand</label>
                                        <select class="form-control" name="brand" >
                                            <option value="">Select...</option>
                                            @foreach ($brands as $brand)
                                            <option value="{{ @$brand->id }}">{{ @$brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>SKU</label>
                                        <input type="text" class="form-control" name="sku" value="{{ old('sku') }}">
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>Price</label>
                                        <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>Offer Price</label>
                                        <input type="text" class="form-control" name="offer_price" value="{{ old('offer_price') }}">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group wsus__input">
                                                <label>Offer Start Date</label>
                                                <input type="text" class="form-control datepicker" name="offer_start_date" value="{{ old('offer_start_date') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group wsus__input">
                                                <label>Offer End Date</label>
                                                <input type="text" class="form-control datepicker" name="offer_end_date" value="{{ old('offer_end_date') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>Stock quantity</label>
                                        <input type="number" min="0" class="form-control" name="qty" value="{{ old('qty') }}">
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>Video Link</label>
                                        <input type="text" class="form-control" name="video_link" value="{{ old('video_link') }}">
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>Short Description</label>
                                        <textarea name="short_description" class="form-control">{{ old('short_description') }}</textarea>
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>Long Description</label>
                                        <textarea name="long_description" class="form-control summernote">{{ old('long_description') }}</textarea>
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>Product Type</label>
                                        <select class="form-control" name="product_type" >
                                            <option value="">Select...</option>
                                            <option value="new_arrival">New Arrival</option>
                                            <option value="featured_product">Featured</option>
                                            <option value="top_product">Top Product</option>
                                            <option value="best_product">Best Product</option>
                                        </select>
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>Seo Title</label>
                                        <input type="text" class="form-control" name="seo_title" value="{{ old('seo_title') }}">
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>Seo Description</label>
                                        <textarea name="seo_description" class="form-control">{{ old('seo_description') }}</textarea>
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>Status</label>
                                        <select class="form-control" name="status" >
                                            <option value="1">Active</option>
                                            <option  value="0">Inactive</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Create</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        $('body').on('change', '.main-category', function(e){
            let id = $(this).val();
            $.ajax({
                    method: 'GET',
                    url: "{{ route('vendor.products.get-subcategories') }}",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        $('.sub-category').html(`<option value="">Select...</option>`);
                        $.each(response, function(i, item){
                            $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`);
                        })
                    },
                    error: function(xhr, status, error) {


                    }
                })
        })

        $('body').on('change', '.sub-category', function(e){
            let id = $(this).val();
            $.ajax({
                    method: 'GET',
                    url: "{{ route('vendor.products.get-childcategories') }}",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        $('.child-category').html(`<option value="">Select...</option>`);
                        $.each(response, function(i, item){
                            $('.child-category').append(`<option value="${item.id}">${item.name}</option>`);
                        })
                    },
                    error: function(xhr, status, error) {


                    }
                })
        })
    })
</script>

@endpush





