@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product Variant Item</h1>
        </div>

        <div class="section-body">


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Variant Item</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.products-variant-item.update', $variantItem->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Variant Name</label>
                                    <input type="text" class="form-control" name="variant_name" value="{{ @$variantItem->productVariant->name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Item Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ @$variantItem->name }}">
                                </div>
                                <div class="form-group">
                                    <label>Price <code>(Set 0 for make it free)</code></label>
                                    <input type="text" class="form-control" name="price" value="{{ @$variantItem->price }}">
                                </div>

                                <div class="form-group">
                                    <label>Is Default</label>
                                    <select class="form-control" name="is_default" >
                                        <option value="">Select...</option>
                                        <option @selected(@$variantItem->is_default === 1) value="1">Yes</option>
                                        <option @selected(@$variantItem->is_default === 0)  value="0">No</option>
                                    </select>
                                </div>

                                <div class="form-group">
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
    </section>
@endsection






