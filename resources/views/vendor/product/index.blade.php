@extends('vendor.layouts.master')

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Products</h3>
                        <div class="create_button">
                            <a href="{{ route('vendor.products.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Create product</a>
                        </div>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                {{ $dataTable->table() }}
                            </div>
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
                    url: "{{ route('vendor.products.change-status') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        status: isChecked,
                        id: id
                    },
                    success: function(response) {
                        toastr.success(response.message);
                        $('#vendorproduct-table').DataTable().draw();
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





