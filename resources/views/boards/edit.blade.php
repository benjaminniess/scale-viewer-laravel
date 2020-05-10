@extends('layouts.default')

@section('content')

    <div class="container main-container">
        <h1 class="title">Edit a board</h1>

        <form method="POST" action="{{route('update_board', $board->id) }}">
            @csrf
            @method('PUT')

            <div class="field">
                <label for="board-title" class="label">Board name</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Enter your board name" value="{{old('title', $board->title)}}" name="title" id="board-title">
                </div>
            </div>

            @error('title')
                <p class="help is-danger">{{$errors->first('title')}}</p>
            @enderror

            <div class="field">
                <label for="board-description" class="label">Description</label>
                <div class="control">
                    <textarea class="textarea" name="description" id="board-description">{{old('description', $board->description)}}</textarea>
                </div>

                @error('description')
                <p class="help is-danger">{{$errors->first('description')}}</p>
                @enderror
            </div>

            <div class="field">
                <label for="board-template" class="label">Template</label>

                <div class="control">
                    @foreach($templates as $template_key => $template_name)
                        <input type="radio" id="template-{{$template_key}}" name="template" value="{{$template_key}}" @if ($board->template === $template_key) checked="checked" @endif>
                        <label for="template-{{$template_key}}">{{$template_name}}</label>
                    @endforeach
                </div>

                @error('template')
                <p class="help is-danger">{{$errors->first('template')}}</p>
                @enderror
            </div>

            <div class="field is-grouped">
                <div class="control">
                    <input type="submit" value="Update" class="button is-link">
                </div>
                <div class="control">
                    <a href="{{$back_permalink}}" class="button is-link is-light">Back</a>
                </div>
            </div>
        </form>
    </div>
    <div class="container main-container">
        <h1 class="title">Manage key numbers</h1>

        @if ( $numbers )
            <ul>
                @foreach ( $numbers as $key => $number )
                    <li>{{$number->title}}: {{$number->number}}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{route('store_number', $board->id) }}">
            @csrf

            <div class="field">
                <label for="new_number" class="label">Number</label>
                <div class="control">
                    <input class="input" type="number" placeholder="Enter a number" value="{{ old('new_number') }}" name="new_number" id="new_number">
                </div>
            </div>

            @error('new_number')
                <p class="help is-danger">{{$errors->first('new_number')}}</p>
            @enderror

            <div class="field">
                <label for="new_number_title" class="label">Title</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Enter the title of the number" value="{{ old('new_number_title') }}" name="new_number_title" id="new_number_title">
                </div>
            </div>

            @error('new_number_title')
                <p class="help is-danger">{{$errors->first('new_number_title')}}</p>
            @enderror

            <div class="field">
                <label for="new_number_description" class="label">Description</label>
                <div class="control">
                    <textarea class="textarea" name="new_number_description" id="new_number_description">{{ old('new_number_description') }}</textarea>
                </div>

                @error('new_number_description')
                    <p class="help is-danger">{{$errors->first('new_number_description')}}</p>
                @enderror
            </div>

            <div class="field">
                <label for="new_number_main_color" class="label">Main color</label>
                <div class="control">
                    <input class="input" type="color" value="{{ old('new_number_main_color') }}" name="new_number_main_color" id="new_number_main_color">
                </div>
            </div>

            @error('new_number_main_color')
            <p class="help is-danger">{{$errors->first('new_number_main_color')}}</p>
            @enderror

            <div class="field">
                <label for="new_number_url" class="label">URL</label>
                <div class="control">
                    <input class="input" type="text" placeholder="https://" value="{{ old('new_number_url') }}" name="new_number_url" id="new_number_url">
                </div>
            </div>

            @error('new_number_url')
            <p class="help is-danger">{{$errors->first('new_number_url')}}</p>
            @enderror

            <div class="field">
                <input type="checkbox" value="1" name="new_number_shortize" id="new_number_shortize" @if (old('new_number_shortize') === 1) checked="checked" @endif>
                <label for="new_number_shortize" class="checkbox">Reduce the block size if too large?</label>
            </div>

            <div class="field">
                <input type="checkbox" value="1" name="new_number_hide_number" id="new_number_hide_number" @if (old('new_number_hide_number') === 1) checked="checked" @endif>
                <label for="new_number_hide_number" class="checkbox">Hide the number label from the board</label>
            </div>

            <div class="field is-grouped">
                <div class="control">
                    <input type="submit" value="Add" class="button is-link">
                </div>
                <div class="control">
                    <a href="{{$back_permalink}}" class="button is-link is-light">Back</a>
                </div>
            </div>
        </form>


    </div>

@endsection

