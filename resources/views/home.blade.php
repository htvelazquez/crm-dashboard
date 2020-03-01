@extends('layouts.admin')

@section('content-header')
    <section class="content-header">
        <h1>Home</h1>
    </section>
@endsection

@section('content')
    <util-tools-dashboard></util-tools-dashboard>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush