@extends('layouts.app')

@section('title')
    {{ $student->name }}
@endsection

@section('content')
    <section class="section">
        <x-bread-crumb title="User">
            <div class="breadcrumb-item"><a href="{{ route('user.index') }}">User Lists</a></div>
            <div class="breadcrumb-item">Detail</div>
        </x-bread-crumb>
    </section>

    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-5">
            <div class="card profile-widget">
                <div class="profile-widget-header">
                    <img alt="image" src="{{ $student->profile_img_path() }}" class="rounded-circle profile-image">
                    <div class="profile-widget-items">
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">ID</div>
                            <div class="profile-widget-item-value">
                                {{ $student->id_no }}
                            </div>
                        </div>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Dept</div>
                            <div class="profile-widget-item-value">
                                {{ $student->department ? $student->department->name : '-' }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-widget-description">
                    <div class="profile-widget-name mb-2">{{ $student->name }}<div
                            class="text-muted d-inline font-weight-normal">
                            <div class="slash"></div> {{ $student->usertype }}
                        </div>
                    </div>
                    <div>
                        <span>{{ $student->email }}</span>
                        <div class="slash"></div>
                        <span>{{ $student->phone }}</span>
                    </div>
                    <p class="mb-4">
                        Date of join :
                        <span
                            class="ml-2">{{ Carbon\Carbon::parse($student->date_of_join)->format('d M Y') }}</span>
                    </p>
                    <p>
                        <i class="fa-solid fa-map-location-dot mr-1"></i>
                        {{ $student->address }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-7">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4>Courses</h4>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Room No</th>
                                <th>Course</th>
                                <th>Start Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="pt-3">
                                    @foreach ($student->rooms as $room)
                                        <p class="mb-2">
                                            {{ $room->name }}
                                            <span class="ml-1">( {{ $room->shift->name }} )</span>
                                        </p>
                                    @endforeach
                                </td>
                                <td class="pt-3">
                                    @foreach ($student->rooms as $room)
                                        <p class="mb-2">{{ $room->course->name }}</p>
                                    @endforeach
                                </td>
                                <td class="pt-3">
                                    @foreach ($student->rooms as $room)
                                        <p class="mb-2">
                                            {{ Carbon\Carbon::parse($room->start_date)->format('d.m.Y') }}</p>
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
