
@extends('layouts.login')

@section('content')
    <section class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                Login
            </div>
            <div class="login-box-body">
                <div class="social-auth-links text-center">
                    <a href="/redirect" class="btn btn-block btn-social btn-google btn-flat">
                        <i class="fab fa-google-plus-g"></i> Sign in using Google+
                    </a>
                </div>

                @if (!empty($message))
                <div class="alert alert-warning" role="alert">
                    {{ $message }}
                </div>
                @endif
            </div>
        </div>
    </section>
@endsection