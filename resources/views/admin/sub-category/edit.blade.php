@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Sub Category</h1>
        </div>

        <div class="section-body">


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Sub Category</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.subcategory.update', $subCategory->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control" name="category" >
                                        <option value="">Select...</option>
                                        @foreach ($categories as $category)
                                        <option @selected($category->id === $subCategory->category_id) value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ @$subCategory->name }}">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status" >
                                        <option @selected(@$subCategory->status === 1) value="1">Active</option>
                                        <option @selected(@$subCategory->status === 0)  value="0">Inactive</option>
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
@push('scripts')
<script>
    $(document).ready(function(){
        $('body').on('change', '.main-category', function(e){
            let id = $(this).val();
            $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.child-category.get-subcategories') }}",
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
    })
</script>

@endpush





