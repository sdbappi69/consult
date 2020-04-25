@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:(0);"> Category </a></li>
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
                                <th>Name</th>
                                <th>Service Name</th>
                                <th>fa-icon</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $sl = $category->appends($req)->firstItem(); @endphp
                            @forelse ($category as $user)
                                <tr class="text-center">
                                    <td>{{ $sl++ }}</td>
                                    <td>{{($user->name ?? 'No Name')}}</td>
                                    <td>{{ $user->service->name ?? null}}</td>
                                    <td>{{ json_decode($user->attributes)->fa_icon }}</td>
                                    <td> @if($user->status == 1) Active @else Pending @endif </td>
                                    <td>
                                        <button data-value="{{$user}}" class="btn btn-primary edit-btn">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No provider's category found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example" class="m-3">
                            <span>Showing {{ $category->appends($req)->firstItem() }} to {{ $category->appends($req)->lastItem() }} of {{ $category  ->appends($req)->total() }} entries</span>
                            <div>{{ $category->appends($req)->render() }}</div>
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
                                {!! Form::label('name','Name')!!}
                                {!! Form::text('name', '', ['class'=>'form-control mb-3','placeholder' => 'Name','id'=>'name'])!!}
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                {!! Form::label('alias','Alias')!!}
                                {!! Form::text('alias', '', ['class'=>'form-control mb-3','placeholder' => 'Alias','id'=>'alias'])!!}
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                {!! Form::label('service_id','Service')!!}
                                {!! Form::select('service_id', $service,null, ['class'=>'form-control mb-3','placeholder' => 'Select a service','id'=>'service_id'])!!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('image','Image')!!}
                                {!! Form::file('image', ['class'=>'form-control mb-3','id'=>'image'])!!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('icon','Icon')!!}
                                {!! Form::file('icon', ['class'=>'form-control mb-3','id'=>'icon'])!!}
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                {!! Form::label('fa_icon','fa-icon')!!}
                                {!! Form::text('fa_icon', '', ['class'=>'form-control mb-3','placeholder' => 'fa icon','id'=>'fa_icon'])!!}
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="form-group">
                                {!! Form::label('status','Status')!!}
                                {!! Form::select('status', [''=>'Select a status',1=>'Active',2=>'De Active'], null,['class'=>'form-control mb-3','id'=>'status','required'=>true])!!}
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
@push('script')
    <script>
        $('#add-new-btn').click(function(){
            $('.add-btn').text('Add');
            $('#relationLabel').text('Add Category');
            var url = "{{route('category.store')}}";
            $('#related_form').attr('action', url);
            $('#related_form').find("input[type=text],input[type=number],input[type=email]").val("");
            $("textarea").each(function(){ $(this).val(''); });
            $("option:selected").prop("selected", false)
            $('#relationModal').modal('show')
            $('.select2').select2({ dropdownParent: $("#relationModal") })
        })
        $('.edit-btn').click(function(){
            $('.add-btn').text('Update');
            $('#relationLabel').text('Update Category');
            var related_data = $(this).data('value');
            var attribute = JSON.parse(related_data.attributes)
            var url = window.location.pathname+'/'+related_data.id+'/update';
            $('#related_form').attr('action', url);
            $('#alias').val(related_data.alias)
            $('#name').val(related_data.name)
            $('#service_id').val(related_data.service_id)
            $('#status').val(related_data.status)
            $('#description').val(attribute.description)
            $('#fa_icon').val(attribute.fa_icon)
            $('#relationModal').modal('show')
            $('.select2').select2({ dropdownParent: $("#relationModal") })
        })
    </script>
@endpush