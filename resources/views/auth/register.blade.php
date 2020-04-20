@extends('layouts.app')

@section('title','Registration')
@push('css')
    <style>
        .page-container{
            padding-left: 0 !important;
        }
    </style>
@endpush
@section('content')
    <div class="page-wrapper">
        <div class="page-container">
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <h3>Registration</h3>
                                        @include('status')
                                    </div>
                                    <form action="{{route('register')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body row">
                                            <div class="col-lg-6">
                                                <div class="card">
                                                    <div class="card-header">Basic Info</div>
                                                    <div class="card-body card-block">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-user"></i>
                                                                </div>
                                                            </div>
                                                            @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-envelope"></i>
                                                                </div>
                                                            </div>
                                                            @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-asterisk"></i>
                                                                </div>
                                                            </div>
                                                            @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-asterisk"></i>
                                                                </div>
                                                            </div>
                                                            @error('password_confirmation')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input id="image" type="file" class="form-control" name="image" required>
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-image"></i>
                                                                </div>
                                                            </div>
                                                            @error('image')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="card">
                                                    <div class="card-header">Additional Info</div>
                                                    <div class="card-body card-block">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                {!! Form::select('service',allServices(),old('service'),['class'=>'form-control','placeholder' => 'Select a service you want to provide','']) !!}
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-cog"></i>
                                                                </div>
                                                            </div>
                                                            @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input id="birth_date" type="text" class="form-control datepicker @error('birth_date') is-invalid @enderror" placeholder="Birth Date" name="birth_date" value="{{ old('birth_date') }}" required>
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                            </div>
                                                            @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header">Contact Mediums</div>
                                                    <div class="card-body card-block">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input id="msisdn" type="text" placeholder="Mobile No" value="{{ old('msisdn') }}" class="form-control @error('msisdn') is-invalid @enderror" name="msisdn" required >
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-mobile-phone"></i>
                                                                </div>
                                                            </div>
                                                            @error('msisdn')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input id="viber" type="text" value="{{ old('viber') }}" placeholder="Viber Number" class="form-control" name="viber">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-viber"></i>
                                                                </div>
                                                            </div>
                                                            @error('viber')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input id="skype" type="text" value="{{ old('skype') }}" placeholder="Skype User name" class="form-control" name="skype">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-skype"></i>
                                                                </div>
                                                            </div>
                                                            @error('skype')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input id="whatsapp" type="text" value="{{ old('whatsapp') }}" placeholder="whatsapp no" class="form-control" name="whatsapp">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-whatsapp"></i>
                                                                </div>
                                                            </div>
                                                            @error('whatsapp')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input id="emo" type="text" value="{{ old('emo') }}" placeholder="emo no" class="form-control" name="emo">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-phone"></i>
                                                                </div>
                                                            </div>
                                                            @error('emo')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input id="telegram" type="text" value="{{ old('telegram') }}" placeholder="telegram no" class="form-control" name="telegram">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-paper-plane"></i>
                                                                </div>
                                                            </div>
                                                            @error('telegram')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <div class="form-actions form-group">
                                                <button type="submit" class="btn btn-success btn-sm">Register</button>
                                                <div class="register-link">
                                                    <p>
                                                        Already have account?
                                                        <a href="{{route('login')}}">Sign In</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script !src="">
        $(document).ready(function () {
            $('.datepicker').datepicker({
                format:'yyyy-m-d'
            })
        })
    </script>
@endpush
