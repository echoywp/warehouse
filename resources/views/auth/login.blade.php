@extends('layouts.app')
@section('title', '员工登录')
@section('css')
    <style>
        @media (min-width: 768px) {
            .row{
                margin-bottom: 20px;
            }
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-5">
            <div class="card">
                <div class="card-header">{{ __('登录') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-lg-2 col-form-label text-md-right">{{ __('姓名') }}</label>
                            <div class="col-md-9 col-lg-9">
                                <input id="email" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-2 col-lg-2 col-form-label text-md-right">{{ __('密码') }}</label>
                            <div class="col-md-9 col-lg-9">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0" style="margin-top: 10px;">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="color: #fff">
                                    {{ __('登录') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
