@extends('layouts.app', [
    'title' => 'Exchange',
])

@section('content')

    <nav class="content-tabs">
        @include('exchange._list', ['pairsList' => $pairsList])
    </nav>

@endsection
