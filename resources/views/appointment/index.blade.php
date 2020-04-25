@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:(0);"> Appointment </a></li>
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
                                    {!! Form::label('f_name','Name')!!}
                                    {!! Form::text('f_name', @$req['f_name'], ['class'=>'form-control mb-3','placeholder' => 'Name','id'=>'f_name'])!!}
                                </div>
                            </div>
                            <div class="col-xl-2">
                                <div class="form-group">
                                    {!! Form::label('f_email','alias')!!}
                                    {!! Form::text('f_email', @$req['f_email'], ['class'=>'form-control mb-3','placeholder' => 'Email','id'=>'f_email'])!!}
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-2">
                                <label for="">&nbsp</label>
                                <button class="btn btn-info btn-block"> Filter  </button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-hover table-center mb-0">
                            <thead>
                            <tr class="text-center">
                                <th>Id</th>
                                <th>Provider Name</th>
                                <th>Category</th>
                                <th>User</th>
                                <th>Medium</th>
                                <th>Date</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $sl = $appointment->appends($req)->firstItem(); @endphp
                            @forelse ($appointment as $user)
                                <tr class="text-center">
                                    <td>{{ $sl++ }}</td>
                                    <td>{{($user->provider->name ?? 'No Name')}}</td>
                                    <td>{{ ($user->category->name ?? 'No Name')}}</td>
                                    <td>{{ ($user->client->name ?? 'No Name')}}</td>
                                    <td>{{ ($user->medium->name ?? 'No Name')}}</td>
                                    <td>{{ $user->date}}</td>
                                    <td>{{ $user->start}}</td>
                                    <td>{{ $user->end}}</td>
                                    <td> @if($user->status == 1) Active @else Pending @endif </td>
                                    <td>
                                        <a href="{{route('appointment.view',$user->id)}}" target="_blank">
                                            <button class="btn btn-primary ">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No appointment found</td>
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
@endsection