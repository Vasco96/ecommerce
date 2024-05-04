@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Category</h1>
        </div>

        <div class="section-body">


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Category</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Icon</label>
                                    <div>
                                        <button name="icon" class="btn btn-primary" data-unselected-class="btn-info" role="iconpicker" data-icon="{{ @$category->icon }}"></button>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ @$category->name }}">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status" >
                                        <option @selected(@$category->status === 1) value="1">Active</option>
                                        <option @selected(@$category->status === 0)  value="0">Inactive</option>
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






