@extends('layouts.default')

@section('content')

    <ul>
        @foreach ($boards as $board)
            <li><a href="/board/{{ $board->id }}">{{ $board->title }}</a></li>
        @endforeach
    </ul>

@endsection

