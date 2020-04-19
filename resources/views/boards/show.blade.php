@extends('layouts.default')

@section('content')

    <div class="container main-container">
        <ul>
            @foreach ($numbers as $number)
                <li>{{ $number->title }} : {{ $number->number }}</li>
            @endforeach
        </ul>

        @if( ! empty($edit_permalink ))
            <a href="{{ $edit_permalink }}" class="button is-primary"><strong>Edit</strong></a>
        @endif
    </div>

@endsection

