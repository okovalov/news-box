@extends('layouts.app', [
    'title' => 'News Topics',
])

@section('content')

    <nav class="content-tabs">
        @include('newsTopic._list', ['newsTopics' => [$active]])
    </nav>

@endsection
