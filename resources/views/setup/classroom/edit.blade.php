@extends('layouts.app')

@section('title')
    Edit {{ $classroom->name }}
@endsection

@section('content')
    <section class="section">
        <x-bread-crumb title="Classroom">
            <div class="breadcrumb-item"><a href="{{ route('classroom.index') }}">Classroom Lists</a></div>
            <div class="breadcrumb-item">Edit Classroom</div>
        </x-bread-crumb>
    </section>

    <div class="row">
        <div class="col-12 col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Classroom</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('classroom.update', $classroom->id) }}" id="editForm" method="POST">
                        @csrf
                        @method('put')

                        <div class="form-row mb-2">
                            <div class="form-group col-md-6">
                                <label>Classroom Name</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $classroom->name) }}" placeholder="Class A">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="">-- Please Choose --</option>
                                    <option value="open" @if ($classroom->status == 'open') selected @endif>Open</option>
                                    <option value="close" @if ($classroom->status == 'close') selected @endif>Close</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row mb-2">
                            <div class="form-group col-md-6">
                                <label>Shift</label>
                                <select name="shift_id" class="form-control select2">
                                    <option value="">-- Please Choose --</option>
                                    @foreach ($shifts as $shift)
                                        <option value="{{ $shift->id }}"
                                            @if (old('shift_id', $classroom->shift_id) == $shift->id) selected @endif>
                                            {{ $shift->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Course</label>
                                <select name="course_id" class="form-control select2">
                                    <option value="">-- Please Choose --</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}"
                                            @if (old('course_id', $classroom->course_id) == $course->id) selected @endif>
                                            {{ $course->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-row mb-2">
                            <div class="form-group col-md-6">
                                <label>Start Date</label>
                                <input type="text" class="form-control start-date" name="start_date"
                                    value="{{ old('start_date', Carbon\Carbon::parse($classroom->start_date)->format('d.m.Y')) }}"
                                    placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label>End Date</label>
                                <input type="text" class="form-control end-date" name="end_date"
                                    value="{{ old('end_date', Carbon\Carbon::parse($classroom->end_date)->format('d.m.Y')) }}"
                                    placeholder="">
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label>Teacher</label>
                            <select name="user_id" class="form-control select2">
                                <option value="">-- Please Choose --</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" @if (old('teacher_id', $classroom->user_id) == $teacher->id) selected @endif>
                                        {{ $teacher->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-5">
                            <label>Description</label>
                            <textarea name="description" class="form-control" id=""
                                rows="8">{{ old('description', $classroom->description) }}</textarea>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('classroom.index') }}" class="btn btn-danger mr-2">Cancel</a>
                            <button class="btn btn-primary px-4">Confirm</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\UpdateClassroomRequest', '#editForm') !!}
    <script>
        $(".start-date").flatpickr({
            dateFormat: "d.m.Y",
        });

        $(".end-date").flatpickr({
            dateFormat: "d.m.Y",
        });
    </script>
@endsection
