@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="content-header-left col-md-12 col-12 mb-2">
            <h3 class="content-header-title mb-0">Permission List</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('permission.index')}}">Permission list</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row m-t-30">
        <div class="col-md-12">
        @include('status')
        <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-striped table-data3">
                    <thead>
                    <tr class="text-center">
                        <th>#SL</th>
                        <th>Name</th>
                        <th>Guard Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($permission)
                        @php $sl = $permission->appends($req)->firstItem(); @endphp
                        @foreach($permission as $m)
                            <tr class="text-center">
                                <td>{{ $sl++ }}</td>
                                <td>{{ $m->name }}</td>
                                <td>{{ $m->guard_name }}</td>
                                <td>
                                    <a href="#" title="edit">
                                        <i class="fa fa-edit edit-btn" data-value="{{$m}}"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <nav aria-label="Page navigation example" class="m-3">
                    <span>Showing {{ $permission->appends($req)->firstItem() }} to {{ $permission->appends($req)->lastItem() }} of {{ $permission  ->appends($req)->total() }} entries</span>
                    <div>{{ $permission->appends($req)->render() }}</div>
                </nav>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
    <header class="page-title">
        <button type="button" class="btn btn-info" id="add-new-btn"><span class="fa fa-plus"></span></button>
    </header>
@endsection
@section('modal')
    <div class="modal fade text-left mt-auto" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel20" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="form-label">PERMISSION</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['route' => 'permission.store','method'=>'post','id'=>'form-id','enctype'=>'multipart/form-data']) !!}
                {!! Form::token() !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">Name</label>
                            {!! Form::text('name','',['class'=>'form-control form-control-sm','id'=>'name','required'=>True]) !!}
                        </div>
                        <div class="col-md-6">
                            <label for="guard">Guard Name</label>
                            {!! Form::text('guard','',['class'=>'form-control form-control-sm','id'=>'guard','required'=>True]) !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success add-btn">Add</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#add-new-btn').click(function(){
            $('.add-btn').text('Add');
            $('#form-label').text('Create Permission');
            var url = "{{route('permission.store')}}";
            $('#form-id').attr('action', url);
            $('#form-id').find("input[type=text],input[type=textarea]").val("");
            $('#dataModal').modal({
                show:true,
                // backdrop: false
            })
        })
        $('.edit-btn').click(function(){
            $('.add-btn').text('Update');
            $('#form-label').text('Update Permission');
            var permission_data = $(this).data('value');
            var url = window.location.pathname+'/'+permission_data.id+'/update';
            $('#form-id').attr('action', url);
            $('#name').val(permission_data.name)
            $('#guard').val(permission_data.guard_name)
            $('#dataModal').modal({
                show:true,
                backdrop: false
            })
        })
    </script>
@endsection