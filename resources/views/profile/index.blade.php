@extends('layouts.app')

@section('title')
    {{ $user->name }}
@endsection

@section('content')
    <section class="section">
        <x-bread-crumb title="Profile">
            <div class="breadcrumb-item">Profile</div>
        </x-bread-crumb>
    </section>

    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-5">
            <div class="card profile-widget">
                <div class="profile-widget-header">
                    <img alt="image" src="{{ $user->profile_img_path() }}" class="rounded-circle profile-image">
                    <div class="profile-widget-items">
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Posts</div>
                            <div class="profile-widget-item-value">187</div>
                        </div>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Followers</div>
                            <div class="profile-widget-item-value">6,8K</div>
                        </div>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Following</div>
                            <div class="profile-widget-item-value">2,1K</div>
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
        <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
                <form action="{{ route('profile.profile-edit') }}" id="editForm" method="POST">
                    @csrf

                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ old('email', $user->email) }}" required>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label>Phone</label>
                            <input type="
                                    tel" class="form-control" name="phone" value="{{ old('phone', $user->phone) }}"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" class="form-control" rows="10">{{ old('address', $user->address) }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\UpdateProfileInfoRequest', '#editForm') !!}
@endsection
