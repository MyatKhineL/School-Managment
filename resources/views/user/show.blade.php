@extends('layouts.app')

@section('title')
    {{ $user->name }}
@endsection

@section('content')
    <section class="section">
        <x-bread-crumb title="User">
            <div class="breadcrumb-item"><a href="{{ route('user.index') }}">User Lists</a></div>
            <div class="breadcrumb-item">Detail</div>
        </x-bread-crumb>
    </section>

    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-7">
            <div class="card profile-widget">
                <div class="profile-widget-header">
                    <img alt="image" src="{{ $user->profile_img_path() }}" class="rounded-circle profile-image">
                    <div class="profile-widget-items">
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">ID</div>
                            <div class="profile-widget-item-value">
                                {{ $user->id_no }}
                            </div>
                        </div>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Dept</div>
                            <div class="profile-widget-item-value">
                                {{ $user->department ? $user->department->name : '-' }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-widget-description">
                    <div class="profile-widget-name mb-2">{{ $user->name }}<div
                            class="text-muted d-inline font-weight-normal">
                            <div class="slash"></div> {{ $user->usertype }}
                        </div>
                    </div>
                    <div>
                        <span>{{ $user->email }}</span>
                        <div class="slash"></div>
                        <span>{{ $user->phone }}</span>
                    </div>
                    <p>{{ $user->address }}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h4>Info</h4>
                </div>
                <div class="card-body">
                    <p class="mb-2">
                        Date of join :
                        <span
                            class="ml-2">{{ Carbon\Carbon::parse($user->date_of_join)->format('d M Y') }}</span>
                    </p>

                    <p class="mb-2">
                        Father Name :
                        <span class="ml-2">{{ $user->fname }}</span>
                    </p>

                    <p class="mb-2">
                        Mother Name :
                        <span class="ml-2">{{ $user->mname }}</span>
                    </p>

                    <p class="mb-2">
                        Gender :
                        <span class="ml-2">{{ $user->gender }}</span>
                    </p>

                    <p class="mb-2">
                        NRC :
                        <span class="ml-2">{{ $user->nrc_number }}</span>
                    </p>

                    <p class="mb-2">
                        Birthday :
                        <span class="ml-2">{{ $user->birthday }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
