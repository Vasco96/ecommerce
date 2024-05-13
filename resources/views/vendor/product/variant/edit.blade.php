@extends('vendor.layouts.master')

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="mb-3">
                        <a href="{{ route('vendor.products-variant.index', ['product' => @$productVariant->product_id]) }}" class="btn btn-primary"><i class="fas fa-angle-left"></i></a>
                    </div>
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Update Variant</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <form action="{{ route('vendor.products-variant.update', @$productVariant->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group wsus__input">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ @$productVariant->name }}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Status</label>
                                        <select class="form-control" name="status" >
                                            <option @selected(@$productVariant->status === 1) value="1">Active</option>
                                            <option @selected(@$productVariant->status === 0)  value="0">Inactive</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection





