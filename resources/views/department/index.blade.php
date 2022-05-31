@extends('layouts.app')

@section('title')
    All Department
@endsection

@section('content')
    <section class="section">
        <x-bread-crumb title="Department">
            <div class="breadcrumb-item">Dep Lists</div>
        </x-bread-crumb>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Departments</h4>
                    <a href="{{ route('department.create') }}" class="btn btn-primary">Add</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover dt-responsive no-wrap w-100" id="dataTable">
                        <thead>
                            <tr>
                                <th class="no-sort"></th>
                                <th>Department</th>
                                <th>Phone</th>
                                <th class="no-sort">Action</th>
                                <th class="hidden">Created_At</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
                ajax: '{{ route('department.ssd') }}',
                columns: [{
                        data: 'plus-icon',
                        name: 'plus-icon',
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                    },
                ],
                order: [
                    [4, "desc"]
                ],
            });
            $(document).on('click', '.del-btn', function(e, id) {
                e.preventDefault();
                var id = $(this).data("id");
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire("Deleted!", "Your file has been deleted.", "success");
                        $.ajax({
                            method: "DELETE",
                            url: `/department/${id}`,
                        }).done(function(res) {
                            console.log('aung p')
                            table.ajax.reload();
                        })
                    }
                });
            })
        })
    </script>
@endsection
