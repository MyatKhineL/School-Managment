@extends('layouts.app')

@section('title')
    Edit {{ $course->name }}
@endsection

@section('content')
    <section class="section">
        <x-bread-crumb title="Course">
            <div class="breadcrumb-item"><a href="{{ route('course.index') }}">Course Lists</a></div>
            <div class="breadcrumb-item">Edit Course</div>
        </x-bread-crumb>
    </section>

    <div class="row">
        <div class="col-12 col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h4>Add User</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('course.update', $course->id) }}" id="editForm" method="POST">
                        @csrf
                        @method('put')

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Course Name</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $course->name) }}" placeholder="English">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Price</label>
                                <input type="text" class="form-control" name="price"
                                    value="{{ old('price', $course->price) }}" placeholder="50000">
                            </div>
                        </div>

                        <div class="form-group mb-5">
                            <label>Description</label>
                            <textarea name="description" class="form-control" cols="30"
                                rows="8">value="{{ old('description', $course->description) }}"</textarea>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('course.index') }}" class="btn btn-danger mr-2">Cancel</a>
                            <button class="btn btn-primary px-4">Confirm</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\UpdateCourseRequest', '#editForm') !!}
@endsection
