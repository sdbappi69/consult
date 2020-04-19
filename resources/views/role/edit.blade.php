@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:(0);">Role</a></li>
                    <li class="breadcrumb-item active">Update</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @include('status')
            {!! Form::model($role,['route' => ['role.update',$role->id],'method'=>'post','enctype'=>'multipart/form-data']) !!}
            {!! Form::token() !!}
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h2>Role Update</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                {!! Form::text('name',old('name')??$role->name,['class'=>'form-control form-control-sm','id'=>'title','required'=>True]) !!}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="guard">Display Name</label>
                                {!! Form::text('guard',old('guard')??$role->guard_name,['class'=>'form-control form-control-sm','id'=>'guard','required'=>True]) !!}
                            </div>
                            <div class="form-group col-md-12">
                                <label for="permission">Permissions</label>
                                <div class="row">
                                    <div class="col-md-5">
                                        {{ Form::select('permission2[]', $permission,null, ['class' => 'form-control site_options', 'id' => 'lstBox1','size' => 10, 'multiple']) }}
                                    </div>
                                    <div class="subject-info-arrows text-center col-md-2"style="margin-top: 20px">
                                        <input type="button" id="btnAllRight" style="width:50px;" value=">>"
                                               class="btn btn-primary"/><br/>
                                        <input type="button" id="btnRight" style="width:50px;" value=">"
                                               class="btn btn-danger"/><br/>
                                        <input type="button" id="btnLeft" style="width:50px;" value="<"
                                               class="btn btn-warning"/><br/>
                                        <input type="button" id="btnAllLeft" style="width:50px;" value="<<"
                                               class="btn btn-primary"/>
                                    </div>
                                    <div class="col-md-5">
                                        {{ Form::select('permission[]',$role->permissions->pluck('name','id'),null, ['class' => 'form-control', 'id' => 'lstBox2','size' => 10,'required'=>true, 'multiple']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        {!! Form::submit('Update',['class'=>'btn btn-primary','id'=>'select_all']) !!}
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            ClassicEditor
                .create(document.querySelector('#synopsis'))
                .then(function (editor) {
                    // The editor instance
                })
                .catch(function (error) {
                    console.error(error)
                })
            // $('.textarea').wysihtml5({
            //     toolbar: { fa: true }
            // })
            $('.select2').select2({
                width: 'resolve'
            });
            $('#my-select, #pre-selected-options').multiSelect()
        })
    </script>
    <script>
        $('#select_all').click(function () {
            $('#lstBox2 option').prop('selected', true);
        });
    </script>
    <script>
        (function () {
            $('#btnRight').click(function (e) {
                var selectedOpts = $('#lstBox1 option:selected');
                if (selectedOpts.length == 0) {
                    alert("Nothing to move.");
                    e.preventDefault();
                }
                $('#lstBox2').append($(selectedOpts).clone());
                $(selectedOpts).remove();
                e.preventDefault();
            });
            $('#btnAllRight').click(function (e) {
                var selectedOpts = $('#lstBox1 option');
                if (selectedOpts.length == 0) {
                    alert("Nothing to move.");
                    e.preventDefault();
                }
                $('#lstBox2').empty()
                $('#lstBox2').append($(selectedOpts).clone());
                $(selectedOpts).remove();
                e.preventDefault();
            });
            $('#btnLeft').click(function (e) {
                var selectedOpts = $('#lstBox2 option:selected');
                if (selectedOpts.length == 0) {
                    alert("Nothing to move.");
                    e.preventDefault();
                }
                $('#lstBox1').append($(selectedOpts).clone());
                $(selectedOpts).remove();
                e.preventDefault();
            });
            $('#btnAllLeft').click(function (e) {
                var selectedOpts = $('#lstBox2 option');
                if (selectedOpts.length == 0) {
                    alert("Nothing to move.");
                    e.preventDefault();
                }
                $('#lstBox1').append($(selectedOpts).clone());
                $(selectedOpts).remove();
                e.preventDefault();
            });
        }(jQuery));
    </script>
@endsection