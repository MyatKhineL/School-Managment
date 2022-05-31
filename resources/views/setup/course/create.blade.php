@extends('layouts.app')

@section('title')
    Create Course
@endsection

@section('content')
    <section class="section">
        <x-bread-crumb title="Course">
            <div class="breadcrumb-item"><a href="{{ route('course.index') }}">Course Lists</a></div>
            <div class="breadcrumb-item">Create Course</div>
        </x-bread-crumb>
    </section>

    <div class="row">
        <div class="col-12 col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h4>Add Course</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('course.store') }}" id="createForm" method="POST">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Course Name</label>
                                <input type="text" class="form-control" name="name" placeholder="English">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Price</label>
                                <input type="text" class="form-control" name="price" placeholder="50000">
                            </div>
                        </div>

                        <div class="form-group mb-5">
                            <label>Description</label>
                            <textarea name="description" class="form-control" cols="30" rows="10"></textarea>
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
    {!! JsValidator::formRequest('App\Http\Requests\StoreCourseRequest', '#createForm') !!}
@endsection
