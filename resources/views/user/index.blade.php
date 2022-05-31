@extends('layouts.app')

@section('title')
    All User
@endsection

@section('content')
    <section class="section">
        <x-bread-crumb title="Department">
            <div class="breadcrumb-item">User Lists</div>
        </x-bread-crumb>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Users</h4>
                    <a href="{{ route('user.create') }}" class="btn btn-primary">Add</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover dt-responsive no-wrap w-100" id="dataTable">
                        <thead>
                            <tr>
                                <th class="no-sort"></th>
                                <th class="no-sort">#</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Type</th>
                                <th class="text-nowrap">Joining date</th>
                                <th class="no-sort">Control</th>
                                <th class="hidden no-sort">Updated_at</th>
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
                ajax: '{{ route('user.ssd') }}',
                columns: [{
                        data: 'plus-icon',
                        name: 'plus-icon',
                    },
                    {
                        data: 'profile_img',
                        name: 'profile_img'
                    },
                    {
                        data: 'id_no',
                        name: 'id_no'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email',
                    },
                    {
                        data: 'dep',
                        name: 'dep',
                    },
                    {
                        data: 'usertype',
                        name: 'usertype',
                    },
                    {
                        data: 'join_date',
                        name: 'join_date',
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
                            url: `/user/${id}`,
                        }).done(function(res) {
                            table.ajax.reload();
                        })
                    }
                });
            })
        })
    </script>
@endsection
