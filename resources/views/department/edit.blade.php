@extends('layouts.app')

@section('title')
    Edit {{ $department->name }}
@endsection

@section('content')
    <section class="section">
        <x-bread-crumb title="Department">
            <div class="breadcrumb-item"><a href="{{ route('department.index') }}">Dep Lists</a></div>
            <div class="breadcrumb-item">Edit Department</div>
        </x-bread-crumb>
    </section>

    <div class="row">
        <div class="col-12 col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Department</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('department.update', $department->id) }}" id="editForm" method="POST">
                        @csrf
                        @method('put')

                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label>Dep Name</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $department->name) }}" placeholder="HR">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone"
                                    value="{{ old('name', $department->phone) }}" placeholder="09421722078">
                            </div>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('department.index') }}" class="btn btn-danger mr-2">Cancel</a>
                            <button class="btn btn-primary px-4">Confirm</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\UpdateDepartmentRequest', '#editForm') !!}
@endsection
