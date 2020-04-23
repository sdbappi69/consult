@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{asset('/')}}vendor/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="{{asset('/')}}vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
@endsection

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:(0);"> Appointment Slot</a></li>
                    <li class="breadcrumb-item active">List</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-sm-12">
            @include('status')
            <div class="card">
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-xl-2">
                                <div class="form-group">
                                    {!! Form::label('f_date','Date')!!}
                                    {!! Form::text('f_date', @$req['f_date'], ['class'=>'form-control mb-3','placeholder' => 'Date','id'=>'f_date'])!!}
                                </div>
                            </div>
                            <div class="col-xl-8"></div>
                            <div class="col-xl-2">
                                <div class="form-group">
                                    <label for="">&nbsp</label>
                                    <button class="btn btn-info btn-block"> Filter  </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-hover table-center mb-0">
                            <thead>
                            <tr class="text-center">
                                <th>Id</th>
                                <th>Provider</th>
                                <th>Date</th>
                                <th>Total Slot</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $sl = $appointment->appends($req)->firstItem(); @endphp
                            @forelse ($appointment as $user)
                                <tr class="text-center">
                                    <td>{{ $sl++ }}</td>
                                    <td>{{ ($user->getProvider->name ?? null)}}</td>
                                    <td>{{($user->date ?? 'No Name')}}</td>
                                    <td>{{ count(json_decode(json_decode($user->attributes)->available_slots) ?? 0) }}</td>
                                    <td> @if($user->status == 1) Active @else Inactive @endif </td>
                                    <td>
                                        <button data-value="{{$user}}" class="btn btn-primary edit-btn">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No slot found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example" class="m-3">
                            <span>Showing {{ $appointment->appends($req)->firstItem() }} to {{ $appointment->appends($req)->lastItem() }} of {{ $appointment  ->appends($req)->total() }} entries</span>
                            <div>{{ $appointment->appends($req)->render() }}</div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <header class="page-title">
        <button type="button" class="btn btn-info" id="add-new-btn"><span class="fa fa-plus"></span></button>
    </header>
@endsection
@section('modal')
    <div class="modal fade" id="relationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="relationLabel">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['url' => '','method'=>'post','id'=>'related_form','enctype'=>"multipart/form-data"]) !!}
                {!! Form::token() !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                {!! Form::label('date','Date')!!}
                                {!! Form::text('date', '', ['class'=>'form-control mb-3 datepicker','placeholder' => 'Appointment Date','id'=>'date','required'=>true])!!}
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                {!! Form::label('status','Status')!!}
                                {!! Form::select('status', [1=>'Active',2=>'De Active'],null, ['class'=>'form-control mb-3','placeholder' => 'Select a status','id'=>'status'])!!}
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                {!! Form::label('slot_duration','Slot Duration')!!}
                                {!! Form::number('slot_duration', '', ['class'=>'form-control mb-3 slot_durationpicker','placeholder' => 'Slot duration','id'=>'slot_duration','required'=>true])!!}
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                {!! Form::label('time_from','Appointment Start From')!!}
                                {!! Form::text('time_from', '', ['class'=>'form-control mb-3 time-slot','placeholder' => 'Slot time','id'=>'time_from','required'=>true])!!}
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                {!! Form::label('time_to','Appointment End To')!!}
                                {!! Form::text('time_to', '', ['class'=>'form-control mb-3 time-slot','placeholder' => 'Slot time','id'=>'time_to','required'=>true])!!}
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="form-group">
                                {!! Form::label('description','Description')!!}
                                {!! Form::textarea('description', null,['class'=>'form-control mb-3','id'=>'description'])!!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary add-btn">Save</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('/')}}vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="{{asset('/')}}vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
@endsection
@push('script')
    <script>
        $('#add-new-btn').click(function(){
            $('.add-btn').text('Add');
            $('#relationLabel').text('Add Appointment');
            var url = "{{route('slot.store')}}";
            $('#related_form').attr('action', url);
            $('#related_form').find("input[type=text],input[type=number],input[type=email]").val("");
            $("textarea").each(function(){ $(this).val(); });
            $("option:selected").prop("selected", false)
            $('#relationModal').modal('show')
        })
        $('.edit-btn').click(function(){
            $('.add-btn').text('Update');
            $('#relationLabel').text('Update Appointment');
            var related_data = $(this).data('value');
            var attribute = JSON.parse(related_data.attributes)
            var slot_data = JSON.parse(attribute.available_slots)
            var url = window.location.pathname+'/'+related_data.id+'/update';
            $('#related_form').attr('action', url);
            $('#date').val(related_data.date)
            $('#status').val(related_data.status)
            $('#description').val(attribute.description)
            $('#slot_duration').val(slot_data[0].duration)
            $('#time_from').val(slot_data[0].start)
            $('#time_to').val(slot_data[slot_data.length-1].end)
            $('#relationModal').modal('show')
        })
        $('#f_date').datepicker({
            format:'yyyy-m-d',
            autoclose: true
        })
        $('#date').datepicker({
            format:'yyyy-m-d',
            autoclose: true,
            startDate: '+1d',
            endDate: '+7d'
        })
        $('.time-slot').datetimepicker({
            minuteStep:5,
            startView: "day",
            minView: 0,
            maxView: 0,
            format: 'HH:ii P',
            pick12HourFormat:true,
            showMeridian: true,
            autoclose: true
        })
    </script>
@endpush