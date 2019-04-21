@extends('layouts.app', [
    'title' => 'Weather',
])

@section('content')

    <nav class="content-tabs">
        @include('weather._list', ['locationList' => $locationList])
    </nav>

@endsection
