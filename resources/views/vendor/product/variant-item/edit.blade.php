@extends('vendor.layouts.master')

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="mb-3">
                        <a href="{{ route('vendor.products-variant-item.index', ['productId' => $variantItem->productVariant->product_id, 'variantId' => $variantItem->product_variant_id]) }}" class="btn btn-primary"><i class="fas fa-angle-left"></i></a>
                    </div>
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Update Variant Items</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <form action="{{ route('vendor.products-variant-item.update', $variantItem->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group wsus__input">
                                        <label>Variant Name</label>
                                        <input type="text" class="form-control" name="variant_name" value="{{ @$variantItem->productVariant->name }}" readonly>
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Item Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ @$variantItem->name }}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Price <code>(Set 0 for make it free)</code></label>
                                        <input type="text" class="form-control" name="price" value="{{ @$variantItem->price }}">
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>Is Default</label>
                                        <select class="form-control" name="is_default" >
                                            <option value="">Select...</option>
                                            <option @selected(@$variantItem->is_default === 1) value="1">Yes</option>
                                            <option @selected(@$variantItem->is_default === 0)  value="0">No</option>
                                        </select>
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>Status</label>
                                        <select class="form-control" name="status" >
                                            <option @selected(@$variantItem->status === 1) value="1">Active</option>
                                            <option @selected(@$variantItem->status === 0)  value="0">Inactive</option>
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





