@extends('layouts.app')

@section('title', 'LGA Results')
@section('heading', 'Select a Local Government to View Summed Results')

@section('content')
    <form method="POST" action="{{ url('/lga-results') }}">
        @csrf
        <div class="mb-3">
            <label for="lga_id" class="form-label">Local Government Area:</label>
            <select class="form-select" name="lga_id" id="lga_id" required>
                <option value="" disabled selected>Select an LGA</option>
                @foreach ($lgas as $lga)
                <option value="{{ $lga->lga_id }}"
                    {{ (old('lga_id') == $lga->lga_id || (isset($selectedLGA) && $selectedLGA->lga_id == $lga->lga_id)) ? 'selected' : '' }}>
                    {{ $lga->lga_name }}
                </option>
            @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">View Result</button>
    </form>

    @if (isset($results))
        <hr class="my-4">
        @if (isset($selectedLGA))
            <h4>Summed Results for: {{ $selectedLGA->lga_name }}</h4>
        @endif

        @if (count($results) > 0)
            <table class="table table-bordered mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>Party</th>
                        <th>Total Score</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $result)
                        <tr>
                            <td>{{ $result->party_abbreviation }}</td>
                            <td>{{ $result->total_score }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning mt-3">No results found for this LGA.</div>
        @endif
    @endif
@endsection
