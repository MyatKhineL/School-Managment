@extends('layouts.app')

@section('title')
    Change Password
@endsection

@section('content')
    <section class="section">
        <x-bread-crumb title="Users">
            <div class="breadcrumb-item">Change Password</div>
        </x-bread-crumb>

        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Change Password</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.update-password') }}" id="editForm" method="POST">
                            @csrf

                            <div class="form-group ">
                                <label for="email">
                                    Current Password
                                </label>
                                <input type="password" class="form-control" placeholder="Current Password"
                                    name="current_password">
                                @error('current_password')
                                    <small class="font-weight-bold text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group my-3">
                                <label for="current">
                                    Change Password
                                </label>
                                <input type="password" class="form-control" id="current" placeholder="New Password"
                                    name="new_password">
                                @error('new_password')
                                    <small class="font-weight-bold text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">
                                    Confirm Password
                                </label>
                                <input type="password" class="form-control" id="repeat" placeholder="Confirm Password"
                                    name="new_confirm_password">
                                @error('new_confirm_password')
                                    <small class="font-weight-bold text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-5">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" required>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">I'm sure</label>
                                </div>

                                <div class="text-center">
                                    <a href="{{ route('profile.index') }}" class="btn btn-danger mr-2">Cancel</a>
                                    <button class="btn btn-primary px-4">Confirm</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
