@extends('layouts.master')

@push('css')
    <style>
        .myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .myImg:hover {opacity: 0.7;}

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1056; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
        }

        /* Modal Content (image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Add Animation */
        .modal-content{
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {-webkit-transform:scale(0)}
            to {-webkit-transform:scale(1)}
        }

        @keyframes zoom {
            from {transform:scale(0)}
            to {transform:scale(1)}
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
            .modal-content {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:(0);"> Appointment </a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    <div class="row">
        <div class="col-sm-12">
            @include('status')
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Patient Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="custom-tab">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active show" id="custom-nav-home-tab" data-toggle="tab" href="#custom-nav-home" role="tab" aria-controls="custom-nav-home" aria-selected="true">Patient Information</a>
                                    <a class="nav-item nav-link" id="custom-nav-contact-tab" data-toggle="tab" href="#custom-nav-contact" role="tab" aria-controls="custom-nav-contact" aria-selected="false">Appointment Info</a>
                                    <a class="nav-item nav-link" id="custom-nav-profile-tab" data-toggle="tab" href="#custom-nav-profile" role="tab" aria-controls="custom-nav-profile" aria-selected="false">Previous Medical Documents</a>
                                    @if($appointment->date == date('Y-m-d') && ((date('h:i A') >= $appointment->start) && (date('h:i A') <= $appointment->end)))
                                        <a class="nav-item nav-link" id="appointment-log-tab" data-toggle="tab" href="#appointment-log" role="tab" aria-controls="appointment-log" aria-selected="false">Appointment Log</a>
                                    @endif
                                </div>
                            </nav>
                            <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                <div class="tab-pane fade active show" id="custom-nav-home" role="tabpanel" aria-labelledby="custom-nav-home-tab">
                                    <div class="row table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td colspan="2">
                                                    <img src="{{asset('/')}}uploads/{{(json_decode($appointment->client->attributes)->image_url ?? 'user.png')}}" class="img img-thumbnail" width="160" alt="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Name</td>
                                                <td> {{$appointment->client->name}} </td>
                                            </tr>
                                            <tr>
                                                <td>Contact No</td>
                                                <td> {{$appointment->client->mobile}} </td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td> {{$appointment->client->email}} </td>
                                            </tr>
                                            <tr>
                                                <td>Age</td>
                                                <td>
                                                    @php
                                                        $dtToronto = \Carbon\Carbon::createFromFormat('Y-m-d',json_decode($appointment->client->attributes)->birth_date);
                                                        $dtVancouver = \Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
                                                        echo $dtVancouver->diffInYears($dtToronto).' Years';
                                                    @endphp
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-nav-contact" role="tabpanel" aria-labelledby="custom-nav-contact-tab">
                                    <div class="row table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>Doctor Name</td>
                                                <td>{{($appointment->provider->name ?? 'No Name')}}</td>
                                            </tr>
                                            <tr>
                                                <td>Appointment Category</td>
                                                <td>{{($appointment->category->name ?? 'No Name')}}</td>
                                            </tr>
                                            <tr>
                                                <td>Appointment Date</td>
                                                <td>{{ $appointment->date }}</td>
                                            </tr>
                                            <tr>
                                                <td>Appointment Time </td>
                                                <td>{{ $appointment->start}} to {{ $appointment->end}}</td>
                                            </tr>
                                            <tr>
                                                <td>Appointment Medium </td>
                                                <td>{{ $appointment->medium->name }}</td>
                                            </tr>
                                            <tr>
                                                <td> Medium No </td>
                                                <td>{{ json_decode(json_decode($appointment->client->attributes)->mediums)->{$appointment->medium->alias} }}</td>
                                            </tr>
                                            <tr>
                                                <td> Appointment Fee </td>
                                                <td>Tk. {{ $appointment->fee }}</td>
                                            </tr>
                                            <tr>
                                                <td> Appointment Reschedule Fee </td>
                                                <td>Tk. {{ $appointment->reschedule_fee }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-nav-profile" role="tabpanel" aria-labelledby="custom-nav-profile-tab">
                                    <div class="row">
                                        @forelse(json_decode($appointment->document->documents) as $file)
                                            @if(file_exists('uploads/'.$file))
                                                @if(strpos(mime_content_type('uploads/'.$file),'image') === 0)
                                                    <div class="col-md-3">
                                                        <img src="{{asset('/')}}uploads/{{$file}}" class="myImg img img-thumbnail" alt="">
                                                    </div>
                                                @elseif(strpos(mime_content_type('uploads/'.$file),'application') === 0 )
                                                    <div class="col-md-3 mb-3">
                                                        <a href="{{asset('/')}}uploads/{{$file}}" target="_blank">
                                                            <span class="badge badge-success"> Click to view pdf file </span>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="col-md-3 mb-3">
                                                        <span class="badge badge-danger"> Invalid Document Found</span>
                                                    </div>
                                                @endif
                                            @endif
                                        @empty
                                            <div class="col-md-12">
                                                No documents found
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                                @if($appointment->date == date('Y-m-d') && ((date('h:i A') >= $appointment->start) && (date('h:i A') <= $appointment->end)))
                                    <div class="tab-pane fade" id="appointment-log" role="tabpanel" aria-labelledby="appointment-log-tab">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <p class="start-msg {{$appointment->status > 1 ? 'd-none' : null}}">Press start button to start your consultation log</p>
                                                <p class="end-msg {{$appointment->status > 3 ? 'd-none' : null}}">Press end button to close your consultation log</p>
                                                <button class="btn btn-success {{$appointment->status > 1 ? 'd-none' : null}} start-log-btn">Start</button>
                                                <button class="btn btn-danger {{$appointment->status > 3 ? 'd-none' : null}} end-log-btn">End</button>
                                                <div class="card mt-4">
                                                    <div class="card-header">
                                                        <h4>Appointment Log</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <td>Patient Name</td>
                                                                <td>Time</td>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="log-body">
                                                            @foreach($appointment->getTimeLog as $log)
                                                                <tr>
                                                                    <td>{{$log->user->name}}</td>
                                                                    <td>{{date('Y-m-d h:i:s A',strtotime($log->time))}}</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <div id="imageModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
    </div>
@endsection

@push('script')
    <script>
        // Get the modal
        var modal = document.getElementById("imageModal");
        $('.myImg').click(function(){
            // Get the image and insert it inside the modal - use its "alt" text as a caption
            var img = $(this);
            console.log()
            var modalImg = document.getElementById("img01");
            modal.style.display = "block";
            modalImg.src = this.src;
        })
        // When the user clicks on <span> (x), close the modal
        $('.close').click(function() {
            modal.style.display = "none";
        });
    </script>
    @if($appointment->date == date('Y-m-d') && ((date('h:i A') >= $appointment->start) && (date('h:i A') <= $appointment->end)))
        <script>
            var log_start = {{($appointment->status == 2 || $appointment->status == 3) ? 1 : 0}}

            $('.start-log-btn').click(function () {
                $.ajax({
                    url: "{{route('appointment.time.log',$appointment->id)}}",
                    method: 'POST',
                    'data': {
                        '_token': "{{csrf_token() }}",
                        'provider_start' : 1
                    },
                    success: function(data) {
                        if(data === 'success'){
                            log_start = 1;
                            $('.start-log-btn').addClass('d-none')
                            $('.end-log-btn').removeClass('d-none')
                            $('.start-msg').addClass('d-none')
                            $('.end-msg').removeClass('d-none')
                            alert('Your consultation started.Please Make sure you press end button while it finished.')
                        }
                        else{
                            alert('Something went wrong!!!!')
                        }
                    },
                    err: function(err) {
                        alert('Something went wrong!!!!')
                    }
                });
            })

            $('.end-log-btn').click(function () {
                $.ajax({
                    url: "{{route('appointment.time.log',$appointment->id)}}",
                    method: 'POST',
                    'data': {
                        '_token': "{{csrf_token() }}",
                        'provider_end': 1
                    },
                    success: function(data) {
                        $('.end-log-btn').addClass('d-none')
                        $('.end-msg').addClass('d-none')
                        log_start = 0
                        alert('Your consultation finished. Thank you!!!')
                    },
                    err: function(err) {
                        alert('Something went wrong!!!!')
                    }
                });
            })

            setInterval(function () {
                if(log_start == 1){
                    $.ajax({
                        url: "{{route('appointment.time.log',$appointment->id)}}",
                        method: 'POST',
                        'data': {
                            '_token': "{{csrf_token() }}"
                        },
                        success: function(data) {
                            console.log(data)
                            if(data !== 'success'){
                                alert('Something went wrong!!!!')
                            }
                        },
                        err: function(err) {
                            alert('Something went wrong!!!!')
                        }
                    })
                }
            },90000)

            setInterval(function () {
                $.ajax({
                    url: "{{route('appointment.time.log.get',$appointment->id)}}",
                    method: 'POST',
                    'data': {
                        '_token': "{{csrf_token() }}"
                    },
                    success: function(data) {
                        $('#log-body').html(data);
                    },
                    err: function(err) {
                        alert('Something went wrong!!!!')
                    }
                });
            },60000)
        </script>
    @endif
@endpush