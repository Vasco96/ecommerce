@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product Image Gallery</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Product: {{ @$product->name }}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.products-image-gallery.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Image <code>(Multiple image supported)</code></label>
                                    <input type="file" name="image[]" class="form-control" multiple>
                                    <input type="hidden" name="product" value="{{ @$product->id }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Images</h4>
                        </div>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $(document).ready(function() {
            $('body').on('click', '.change-status', function() {
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');
                $.ajax({
                    method: 'PUT',
                    url: "{{ route('admin.products.change-status') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        status: isChecked,
                        id: id
                    },
                    success: function(response) {
                        toastr.success(response.message);
                        $('#product-table').DataTable().draw();
                    },
                    error: function(xhr, status, error) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(index, value){
                            toastr.error(value);
                        });

                    }
                })


            })
        })
    </script>
@endpush
