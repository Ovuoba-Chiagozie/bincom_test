<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Election System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Election System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('polling-units.index') ? 'active' : '' }}"
                            href="{{ route('polling-units.index') }}">Polling Units</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('lga.results') ? 'active' : '' }}"
                            href="{{ route('lga.results') }}">LGA Results</a>
                    </li>
                    @unless (request()->routeIs('polling-units.create'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('polling-units.create') }}">Create Polling Unit</a>
                        </li>
                    @endunless
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="mb-4">@yield('heading')</h1>
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
