@extends('layouts.app')

@section('title')
    Create Shift
@endsection

@section('content')
    <section class="section">
        <x-bread-crumb title="Shift">
            <div class="breadcrumb-item"><a href="{{ route('shift.index') }}">Shift Lists</a></div>
            <div class="breadcrumb-item">Create Shift</div>
        </x-bread-crumb>
    </section>

    <div class="row">
        <div class="col-12 col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h4>Add Shift</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('shift.store') }}" id="createForm" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Shift Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Morning">
                        </div>

                        <div class="form-row  mb-5">
                            <div class="form-group col-md-6">
                                <label>Start Time</label>
                                <input type="text" class="form-control custom-time-picker" name="start_time"
                                    placeholder="English">
                            </div>
                            <div class="form-group col-md-6">
                                <label>End Time</label>
                                <input type="text" class="form-control custom-time-picker" name="end_time"
                                    placeholder="50000">
                            </div>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('shift.index') }}" class="btn btn-danger mr-2">Cancel</a>
                            <button class="btn btn-primary px-4">Confirm</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\StoreShiftRequest', '#createForm') !!}
    <script>
        $(".custom-time-picker")
            .daterangepicker({
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
                timePickerSeconds: true,
                autoApply: true,
                locale: {
                    format: "HH:mm:ss",
                },
            })
            .on("show.daterangepicker", function(ev, picker) {
                picker.container.find(".calendar-table").hide();
            });
    </script>
@endsection
