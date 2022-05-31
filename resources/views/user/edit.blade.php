@extends('layouts.app')

@section('title')
    Edit {{ $user->name }}
@endsection

@section('content')
    <section class="section">
        <x-bread-crumb title="Users">
            <div class="breadcrumb-item"><a href="{{ route('user.index') }}">User Lists</a></div>
            <div class="breadcrumb-item">Eidt User</div>
        </x-bread-crumb>

        <div class="row">
            <div class="col-12 col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h4>Eidt User</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.update', $user->id) }}" id="editForm" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="form-row mb-2">
                                <div class="form-group col-md-6">
                                    <label>User ID</label>
                                    <input type="text" class="form-control" name="id_no"
                                        value="{{ old('id_no', $user->id_no) }}" placeholder="ID Number">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ old('name', $user->name) }}" placeholder="Username">
                                </div>
                            </div>

                            <div class="form-row mb-2">
                                <div class="form-group col-md-6">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email"
                                        value="{{ old('email', $user->email) }}" placeholder="user@gmail.com">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password"
                                        value="{{ old('password') }}" placeholder="Password">
                                </div>
                            </div>

                            <div class="form-row mb-2">
                                <div class="form-group col-md-6">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" name="phone"
                                        value="{{ old('phone', $user->phone) }}" placeholder="09421722078">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>NRC</label>
                                    <input type="text" class="form-control" name="nrc"
                                        value="{{ old('nrc', $user->nrc_number) }}" placeholder="NRC Number">
                                </div>
                            </div>

                            <div class="form-row mb-2">
                                <div class="form-group col-md-6">
                                    <label>Mother</label>
                                    <input type="text" class="form-control" name="mname"
                                        value="{{ old('mname', $user->mname) }}" placeholder="Daw Hla">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Father</label>
                                    <input type="text" class="form-control" name="fname"
                                        value="{{ old('fname', $user->fname) }}" placeholder="U Ba">
                                </div>
                            </div>

                            <div class="form-row mb-2 custom-form">
                                <div class="form-group col-md-6">
                                    <label>Birthday</label>
                                    <input type="text" class="form-control bd" name="birthday"
                                        value="{{ old('birthday', Carbon\Carbon::parse($user->birthday)->format('d.m.Y')) }}"
                                        placeholder="Birth Date">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Date of Join</label>
                                    <input type="text" class="form-control doj" name="date_of_join"
                                        value="{{ old('date_of_join', Carbon\Carbon::parse($user->date_of_join)->format('d.m.Y')) }}"
                                        placeholder="Date Of Join">
                                </div>
                            </div>

                            <div class="form-row mb-2">
                                <div class="form-group col-md-6">
                                    <label>Gender</label>
                                    <select class="form-control" name="gender">
                                        <option value="male" @if ($user->gender == 'male') selected @endif>Male</option>
                                        <option value="female" @if ($user->gender == 'female') selected @endif>Female
                                        </option>
                                    </select>

                                </div>
                                <div class="form-group col-md-6">
                                    <label>Profile Photo</label>
                                    <input type="file" class="form-control p-1" name="profile_photo"
                                        value="{{ old('profile_photo', $user->profile_photo) }}"
                                        accept="image/png, image/jpeg">
                                </div>
                            </div>

                            <div class="form-row mb-2">
                                <div class="form-group col-md-6">
                                    <label>User Type</label>
                                    <select class="form-control select2" name="usertype">
                                        <option value="">-- Please Choose --</option>
                                        <option value="admin" @if ($user->usertype == 'admin') selected @endif>Admin
                                        </option>
                                        <option value="employee" @if ($user->usertype == 'employee') selected @endif>Employee
                                        </option>
                                        <option value="student" @if ($user->usertype == 'student') selected @endif>Student
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Department</label>
                                    <select name="department_id" class="form-control select2">
                                        <option value="">-- Please Choose --</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}"
                                                @if (old('department_id', $user->department_id) == $department->id) selected @endif>
                                                {{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-5">
                                <label>Address</label>
                                <textarea name="address" class="form-control" rows="10">{{ old('address', $user->address) }}</textarea>
                            </div>

                            <div class="text-center">
                                <a href="{{ route('user.index') }}" class="btn btn-danger mr-2">Cancel</a>
                                <button class="btn btn-primary px-4">Confirm</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\UpdateUserRequest', '#editForm') !!}
    <script>
        $(".bd").flatpickr({
            maxDate: "today",
            dateFormat: "d.m.Y",
        });

        $(".doj").flatpickr({
            dateFormat: "d.m.Y",
        });
    </script>
@endsection
