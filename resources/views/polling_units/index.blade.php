@extends('layouts.app')

@section('title', 'Select Polling Unit')
@section('heading', 'Select a Polling Unit to View Results')


@section('content')
    <form method="POST" action="{{ route('polling-units.search') }}">
        @csrf
        <div class="mb-3">
            <label for="polling_unit_id" class="form-label">Polling Unit:</label>
            <select class="form-select" name="polling_unit_id" id="polling_unit_id" required>
                <option value="" disabled selected>Select a polling unit</option>
                @foreach ($pollingUnits as $pu)
                    <option value="{{ $pu->uniqueid }}"
                        {{ old('polling_unit_id') == $pu->uniqueid || (isset($selectedPU) && $selectedPU->uniqueid == $pu->uniqueid) ? 'selected' : '' }}>
                        {{ $pu->polling_unit_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">View Result</button>
    </form>

    @if (isset($results))
        <hr class="my-4">
        <h4>Results for: {{ $selectedPU->polling_unit_name }} </h4>

        @if (count($results) > 0)
            <table class="table table-bordered mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>Party</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $result)
                        <tr>
                            <td>{{ $result->party_abbreviation }}</td>
                            <td>{{ $result->party_score }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning mt-3">No results found for this polling unit.</div>
        @endif
    @endif
@endsection
