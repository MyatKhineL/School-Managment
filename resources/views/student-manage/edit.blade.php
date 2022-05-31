@extends('layouts.app')

@section('title')
    Edit {{ $student->name }}s Courses
@endsection

@section('content')
    <section class="section">
        <x-bread-crumb title="Student's Courses">
            <div class="breadcrumb-item"><a href="{{ route('student.index') }}">Student Lists</a></div>
            <div class="breadcrumb-item">Edit Courses</div>
        </x-bread-crumb>
    </section>

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit {{ $student->name }}'s Courses</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('student.update', $student->id) }}" id="editForm" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Student</label>
                            <select name="user_id" class="form-control select2">
                                <option value="">-- Please Choose --</option>
                                <option value="{{ $student->id }}" selected>
                                    {{ $student->name }}
                                </option>
                            </select>
                        </div>

                        <div class="form-group mb-5">
                            <label>Courses</label>
                            <select name="rooms[]" class="form-control select2" multiple="">
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}" @if (in_array($room->id, $old_rooms)) selected @endif>
                                        {{ $room->name }} ( {{ $room->course->name }} )
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('student.index') }}" class="btn btn-danger mr-2">Cancel</a>
                            <button class="btn btn-primary px-4">Confirm</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\UpdateStudentManageRequest', '#editForm') !!}
@endsection
