@extends('layouts.admin')

@section('content-header')
    <section class="content-header">
        <h1>Leadgen data</h1>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <leadgen-data></leadgen-data>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush