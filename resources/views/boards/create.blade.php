@extends('layouts.default')

@section('content')

    <div class="container main-container">
        <h1 class="title">Create a new board</h1>

        <form method="POST" action="{{route('store_board')}}">
            @csrf

            <div class="field">
                <label for="board-title" class="label">Board name</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Enter your board name" value="{{ old('title') }}" name="title" id="board-title">
                </div>
            </div>

            @error('title')
                <p class="help is-danger">{{$errors->first('title')}}</p>
            @enderror

            <div class="field">
                <label for="board-description" class="label">Description</label>
                <div class="control">
                    <textarea class="textarea" name="description" id="board-description">{{ old('description') }}</textarea>
                </div>

                @error('description')
                    <p class="help is-danger">{{$errors->first('description')}}</p>
                @enderror
            </div>

            <div class="field is-grouped">
                <div class="control">
                    <input type="submit" value="Add" class="button is-link">
                </div>
                <div class="control">
                    <a href="{{route('home')}}" class="button is-link is-light">Back</a>
                </div>
            </div>
        </form>
    </div>

@endsection

