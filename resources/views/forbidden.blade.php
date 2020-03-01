
@extends('layouts.login')

@section('content')
    <section class="hold-transition login-page">
        <div class="login-box">
            <div class="login-box-body">
                <div class="alert alert-warning" role="alert">
                    Access Forbidden
                </div>

                @if (null === auth()->user())
                <a href="/redirect" class="btn btn-block btn-social btn-google btn-flat">
                    <i class="fab fa-google-plus-g"></i> Sign in using Google+
                </a>
                @endif
            </div>
        </div>
    </section>
@endsection