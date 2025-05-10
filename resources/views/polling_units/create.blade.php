@extends('layouts.app')

@section('title', 'Create New Polling Unit')
@section('heading', 'Create New Polling Unit and Add Results')


@section('content')
    @if (session('success'))
        <div class="modal fade show" id="successModal" tabindex="-1" style="display: block;" aria-modal="true" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Success</h5>
                    </div>
                    <div class="modal-body">
                        <p>{{ session('success') }}</p>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('polling-units.create') }}" class="btn btn-primary">Create Another Polling
                            Unit</a>
                        <a href="{{ route('polling-units.index') }}" class="btn btn-secondary">View Polling Units</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @else
        <form method="POST" action="{{ route('polling-units.store') }}">
            @csrf


            <div class="mb-3">
                <label for="polling_unit_name" class="form-label">Polling Unit Name:</label>
                <input type="text" class="form-control" name="polling_unit_name" id="polling_unit_name" required>
            </div>


            <div class="mb-3">
                <label for="ward_id" class="form-label">Ward:</label>
                <select class="form-select" name="ward_id" id="ward_id" required>
                    <option value="" disabled selected>Select a ward</option>
                    @foreach ($wards as $ward)
                        <option value="{{ $ward->ward_id }}">{{ $ward->ward_name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mb-3">
                <label for="lga_id" class="form-label">LGA:</label>
                <select class="form-select" name="lga_id" id="lga_id" required>
                    <option value="" disabled selected>Select a Local Government Area</option>
                    @foreach ($lgas as $lga)
                        <option value="{{ $lga->lga_id }}">{{ $lga->lga_name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mb-3">
                <label for="party_results" class="form-label">Party Results:</label>
                <div class="row">
                    @foreach ($parties as $party)
                        <div class="col-md-3">
                            <label for="party_{{ $party->partid }}" class="form-label">{{ $party->partyname }}</label>
                            <input type="number" class="form-control" name="party_scores[{{ $party->partyid }}]"
                                id="party_{{ $party->partid }}" required>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Create Polling Unit</button>
        </form>
    @endif
@endsection
