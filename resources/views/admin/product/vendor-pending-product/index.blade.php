@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Vendors Pending Product</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Vendor Pending Products</h4>
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
                        $('#adminvendorpendingproduct-table').DataTable().draw();
                    },
                    error: function(xhr, status, error) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(index, value){
                            toastr.error(value);
                        });

                    }
                })


            })

            //Change approved status

            $('body').on('change', '.is_approved', function() {
                let value = $(this).val();
                let id = $(this).data('id');
                $.ajax({
                    method: 'PUT',
                    url: "{{ route('admin.change-approved-status') }}",
                    data: {
                        value: value,
                        id: id
                    },
                    success: function(response) {
                        toastr.success(response.message);
                        $('#adminvendorpendingproduct-table').DataTable().draw();
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
