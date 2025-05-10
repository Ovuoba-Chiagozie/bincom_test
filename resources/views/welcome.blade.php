@extends('layouts.app')

@section('title', 'Welcome')
@section('heading', 'Delta State Election Results Portal')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 text-center">
        <div class="mb-5">
            <h2 class="display-4 mb-4">Welcome to Delta State's Election Management System 👋</h2>
            <p class="lead text-muted">
                Your comprehensive platform for accessing and managing election results across Delta State. 
                Track polling unit results, analyze LGA summaries, and contribute to our democratic process.
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">View Polling Unit Results</h5>
                        <p class="card-text">Access detailed results from individual polling units across the state.</p>
                        <a href="{{ route('polling-units.index') }}" class="btn btn-primary w-100">View Results</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Create New Polling Unit</h5>
                        <p class="card-text">Add new polling unit results to our comprehensive database.</p>
                        <a href="{{ route('polling-units.create') }}" class="btn btn-success w-100">Create Unit</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">LGA Results Summary</h5>
                        <p class="card-text">View aggregated results and analysis by Local Government Area.</p>
                        <a href="{{ route('lga.results') }}" class="btn btn-info w-100">View LGA Results</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <p class="text-muted">
                <small>Empowering transparency and accountability in Delta State's electoral process.</small>
            </p>
        </div>
    </div>
</div>
@endsection