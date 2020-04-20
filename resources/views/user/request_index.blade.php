@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:(0);"> User Request</a></li>
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
                                    {!! Form::label('f_email','Email')!!}
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
                                <th>Name</th>
                                <th>Mobile NO</th>
                                <th>Email</th>
                                <th>Image</th>
                                <th>Profession</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $sl = $users->appends($req)->firstItem(); @endphp
                            @forelse ($users as $user)
                                <tr class="text-center">
                                    <td>{{ $sl++ }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->mobile }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><img src="{{asset('/')}}uploads/{{ (json_decode($user->attributes)->image_url ?? null)}}" width="40" alt=""></td>
                                    <td>{{ (json_decode($user->attributes)->profession ?? null)}}</td>
                                    <td>
                                        <button data-value="{{$user}}" class="btn btn-primary edit-btn">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No user found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example" class="m-3">
                            <span>Showing {{ $users->appends($req)->firstItem() }} to {{ $users->appends($req)->lastItem() }} of {{ $users  ->appends($req)->total() }} entries</span>
                            <div>{{ $users->appends($req)->render() }}</div>
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
    <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="relationLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['route' => 'user.request_list.store','method'=>'post','id'=>'related_form','enctype'=>"multipart/form-data"]) !!}
                {!! Form::token() !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                {!! Form::label('name','User name')!!}
                                {!! Form::text('name', '', ['class'=>'form-control mb-3','placeholder' => 'User name','id'=>'name'])!!}
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                {!! Form::label('email','User email')!!}
                                {!! Form::email('email', '', ['class'=>'form-control mb-3','placeholder' => 'User email','id'=>'email'])!!}
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                {!! Form::label('service_charge_percentage','Service Charge Percentage')!!}
                                {!! Form::text('service_charge_percentage', '', ['class'=>'form-control mb-3','placeholder' => 'Service Charge Percentage','id'=>'service_charge_percentage'])!!}
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                {!! Form::label('role','User Role')!!}
                                {!! Form::select('role', [''=>'Select a role']+allRoles(), null,['class'=>'form-control mb-3','id'=>'role','required'=>true])!!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="modal fade" id="acceptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="relationLabel">Accept User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['url' => '','method'=>'post','id'=>'accept_form','enctype'=>"multipart/form-data"]) !!}
                {!! Form::token() !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                {!! Form::label('name','User name')!!}
                                {!! Form::text('name', '', ['class'=>'form-control mb-3','placeholder' => 'User name','id'=>'name','disabled' => true,])!!}
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                {!! Form::label('email','User email')!!}
                                {!! Form::email('email', '', ['class'=>'form-control mb-3','placeholder' => 'User email','id'=>'email','disabled' => true])!!}
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                {!! Form::label('service_charge_percentage','Service Charge Percentage')!!}
                                {!! Form::text('service_charge_percentage', '', ['class'=>'form-control mb-3','placeholder' => 'Service Charge Percentage','id'=>'service_charge_percentage'])!!}
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                {!! Form::label('role','User Role')!!}
                                {!! Form::select('role', [''=>'Select a role']+allRoles(), null,['class'=>'form-control mb-3','id'=>'role','required'=>true])!!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Accept</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $('#add-new-btn').click(function(){
            $('#related_form').find("input[type=text],input[type=number],input[type=email]").val("");
            $("textarea").each(function(){ $(this).val(); });
            $("option:selected").prop("selected", false)
            $('#newModal').modal('show')
        })
        $('.edit-btn').click(function(){
            var related_data = $(this).data('value');
            var url = window.location.pathname+'/'+related_data.id+'/update';
            console.log(url);
            $('#accept_form').attr('action', url);
            $('#name').val(related_data.name)
            $('#email').val(related_data.email)
            $('#acceptModal').modal('show')
        })
    </script>
@endpush