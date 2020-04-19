@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:(0);"> Users</a></li>
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
                            <div class="col-xl-2">
                                <div class="form-group">
                                    {!! Form::label('f_role','Role')!!}
                                    {!! Form::select('f_role', [''=>'Select a role']+allRoles(),@$req['f_role'], ['class'=>'form-control mb-3','id'=>'f_role'])!!}
                                </div>
                            </div>
                            <div class="col-md-4"></div>
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
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $sl = $users->appends($req)->firstItem(); @endphp
                            @forelse ($users as $user)
                                <tr class="text-center">
                                    <td>{{ $sl++ }}</td>
                                    <td>{{($user->name ?? 'No Name')}}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ ($user->roles->first()->name ?? null) }}</td>
                                    <td> @if($user->status == 1) Active @else Inactive @endif </td>
                                    <td>
                                        <button data-value="{{$user}}" data-role="{{$user->roles->first()}}" class="btn btn-primary edit-btn">
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
                                {!! Form::label('name','User name')!!}
                                {!! Form::text('name', '', ['class'=>'form-control mb-3','placeholder' => 'User name','id'=>'name','required'=>true])!!}
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                {!! Form::label('email','User email')!!}
                                {!! Form::email('email', '', ['class'=>'form-control mb-3','placeholder' => 'User email','id'=>'email'])!!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('image','User Image')!!}
                                {!! Form::file('image', ['class'=>'form-control mb-3','id'=>'image'])!!}
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
                    <button type="submit" class="btn btn-primary add-btn">Save</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $('#add-new-btn').click(function(){
            $('.add-btn').text('Add');
            $('#relationLabel').text('Add User');
            var url = "{{route('user.store')}}";
            $('#related_form').attr('action', url);
            $('#related_form').find("input[type=text],input[type=number],input[type=email]").val("");
            $("textarea").each(function(){ $(this).val(); });
            $("option:selected").prop("selected", false)
            $('#relationModal').modal('show')
        })
        $('.edit-btn').click(function(){
            $('.add-btn').text('Update');
            $('#relationLabel').text('Update User');
            var related_data = $(this).data('value');
            var related_info= $(this).data('info');
            var role_info= $(this).data('role');
            var url = window.location.pathname+'/'+related_data.id+'/update';
            $('#related_form').attr('action', url);
            $('#name').val(related_data.name)
            $('#email').val(related_data.email)
            $('#role').val(role_info.name)
            $('#relationModal').modal('show')
        })
    </script>
@endpush