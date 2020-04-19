@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="content-header-left col-md-12 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('permission.index')}}">Role list</a>
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
                    @if($role)
                        @php $sl = $role->appends($req)->firstItem(); @endphp
                        @foreach($role as $m)
                            <tr class="text-center">
                                <td>{{ $sl++ }}</td>
                                <td>{{ $m->name }}</td>
                                <td>{{ $m->guard_name }}</td>
                                <td>
                                    <a href="{{route('role.edit',$m->id)}}" title="edit">
                                        <i class="fa fa-edit edit-btn" data-value="{{$m}}"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <nav aria-label="Page navigation example" class="m-3">
                    <span>Showing {{ $role->appends($req)->firstItem() }} to {{ $role->appends($req)->lastItem() }} of {{ $role  ->appends($req)->total() }} entries</span>
                    <div>{{ $role->appends($req)->render() }}</div>
                </nav>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
    <a href="{{route('role.create')}}">
        <header class="page-title">
            <button type="button" class="btn btn-info" id="add-new-btn"><span class="fa fa-plus"></span></button>
        </header>
    </a>
@endsection