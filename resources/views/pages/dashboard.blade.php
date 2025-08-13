@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-xl-4 col-lg-6 col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Tasks Overview</h5>
                </div>
                <div class="card-body">
                    <p>Pending: 5</p>
                    <p>Completed: 12</p>
                    <p>Overdue: 2</p>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Projects Overview</h5>
                </div>
                <div class="card-body">
                    <p>Active: 3</p>
                    <p>Completed: 7</p>
                    <p>On Hold: 1</p>
                </div>
            </div>
        </div>
    </div>
@endsection
