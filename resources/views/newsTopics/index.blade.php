@extends('layouts.app', [
    'title' => 'News Topics',
])

@section('content')

    <nav class="content-tabs">
        @include('newsTopics._list', ['newsTopics' => $active])
    </nav>

@endsection
