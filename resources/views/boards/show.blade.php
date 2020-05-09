@extends('layouts.default')

@section('content')

    <div class="container main-container">
        <div class="numbers-container">
            @foreach ($numbers as $number)
                <div class="number-older">
                    <div class="number-surface" style="
                    @foreach($number['extraData']['css'] as $property => $value)
                    {{$property}}:{{$value}};
                    @endforeach
                        "></div>
                    <p>{{$number['number']}}</p>
                    <h4>{{$number['title']}}</h4>
                    @if ( $number['description'] )
                        <!--<p>{{$number['description']}}</p>-->
                    @endif
                </div>

            @endforeach
        </div>

        {!!$board->description!!}

        @if( ! empty($edit_permalink ))
            <p><a href="{{ $edit_permalink }}" class="button is-primary"><strong>Edit</strong></a></p>
        @endif


    </div>

@endsection

