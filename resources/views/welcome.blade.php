@extends('layouts.default')

@section('content')

    <div class="container main-container">
        <ul>
            @foreach ($boards as $board)
                <li><a href="/board/{{ $board->id }}">{{ $board->title }}</a></li>
            @endforeach
        </ul>
    </div>
@endsection

