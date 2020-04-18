@extends('layouts.default')

@section('content')

    <ul>
        @foreach ($numbers as $number)
            <li>{{ $number->title }} : {{ $number->number }}</li>
        @endforeach
    </ul>

@endsection

