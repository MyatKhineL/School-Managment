@extends('layouts.app')

@section('title')
    Student Lists
@endsection

@section('content')
    <section class="section">
        <x-bread-crumb title="Student Lists">
            <div class="breadcrumb-item">Dep Lists</div>
        </x-bread-crumb>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Student Lists</h4>
                    <a href="{{ route('student.take-course') }}" class="btn btn-primary">Add</a>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-hover dt-responsive no-wrap w-100" id="dataTable">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Room</th>
                                <th>Courses</th>
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
                ajax: '{{ route('student.ssd') }}',
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'room',
                        name: 'room',
                    },
                    {
                        data: 'course',
                        name: 'course',
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

        })
    </script>
@endsection
