@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb', 'Dashboard')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-4 col-lg-6 col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Tasks Overview</h5>
                </div>
                <div class="card-body">
                    <p>Pending: {{ $incomplete }}</p>
                    <p>Completed: {{ $complete }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
