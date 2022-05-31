@extends('layouts.app')

@section('title')
    {{ $classroom->name }}
@endsection

@section('content')
    <section class="section">
        <x-bread-crumb title="Classroom">
            <div class="breadcrumb-item"><a href="{{ route('classroom.index') }}">Classroom Lists</a></div>
            <div class="breadcrumb-item">Detail</div>
        </x-bread-crumb>
    </section>

    <div class="row">
        <div class="col-12 col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $classroom->name }}</h4>
                    @if ($classroom->status == 'open')
                        <span class="badge bg-success text-white">Open</span>
                    @else
                        <span class="badge bg-danger text-white">Close</span>
                    @endif
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-6 col-md-4 col-lg-3 mb-3">
                            <p class="mb-1 font-weight-normal">
                                <i class="fa-brands fa-discourse mr-1 font-weight-light"></i>
                                Course
                            </p>
                            <p class="h6 font-weight-bold">{{ $classroom->course->name }}</p>
                        </div>

                        <div class="col-6 col-md-4 col-lg-3 mb-3">
                            <p class="mb-1 font-weight-normal">
                                <i class="fa-solid fa-person-chalkboard mr-1"></i>
                                Teacher
                            </p>
                            <p class="h6 font-weight-bold">{{ $classroom->teacher->name }}</p>
                        </div>

                        <div class="col-6 col-md-4 col-lg-3 mb-3">
                            <p class="mb-1 font-weight-normal">
                                <i class="fa-solid fa-calendar-days mr-1"></i>
                                Start Date
                            </p>
                            <p class="h6 font-weight-bold">
                                {{ Carbon\Carbon::parse($classroom->start_date)->format('d.m.Y') }}</p>
                        </div>

                        <div class="col-6 col-md-4 col-lg-3 mb-3">
                            <p class="mb-1 font-weight-normal">
                                <i class="fa-solid fa-calendar-days mr-1"></i>
                                End Date
                            </p>
                            <p class="h6 font-weight-bold">
                                {{ Carbon\Carbon::parse($classroom->end_date)->format('d.m.Y') }}</p>
                        </div>
                    </div>

                    <p>
                        {{ $classroom->description }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
