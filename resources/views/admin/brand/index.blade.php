@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Brand</h1>
        </div>

        <div class="section-body">


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Brands</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.brand.create') }}" class="btn btn-primary"><i
                                        class="fas fa-plus"></i> Create New</a>
                            </div>
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
                    url: "{{ route('admin.brand.change-status') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        status: isChecked,
                        id: id
                    },
                    success: function(response) {
                        toastr.success(response.message);
                        $('#brand-table').DataTable().draw();
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
