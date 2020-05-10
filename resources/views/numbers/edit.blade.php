@extends('layouts.default')

@section('content')

    <div class="container main-container">
        <h1 class="title">Manage key numbers</h1>

        <form method="POST" action="{{route('update_number', [ 'board' => $board->id, 'number' => $number->id ]) }}">
            @csrf
            @method('PUT')

            <div class="field">
                <label for="update_number" class="label">Number</label>
                <div class="control">
                    <input class="input" type="number" placeholder="Enter a number" value="{{ old('update_number', $number->number) }}" name="update_number" id="update_number">
                </div>
            </div>

            @error('update_number')
                <p class="help is-danger">{{$errors->first('update_number')}}</p>
            @enderror

            <div class="field">
                <label for="update_number_title" class="label">Title</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Enter the title of the number" value="{{ old('update_number_title', $number->title) }}" name="update_number_title" id="update_number_title">
                </div>
            </div>

            @error('update_number_title')
                <p class="help is-danger">{{$errors->first('update_number_title')}}</p>
            @enderror

            <div class="field">
                <label for="update_number_description" class="label">Description</label>
                <div class="control">
                    <textarea class="textarea" name="update_number_description" id="update_number_description">{{ old('update_number_description', $number->description) }}</textarea>
                </div>

                @error('update_number_description')
                    <p class="help is-danger">{{$errors->first('update_number_description')}}</p>
                @enderror
            </div>

            <div class="field">
                <label for="update_number_main_color" class="label">Main color</label>
                <div class="control">
                    <input class="input" type="color" value="{{ old('update_number_main_color', $number->main_color) }}" name="update_number_main_color" id="update_number_main_color">
                </div>
            </div>

            @error('update_number_main_color')
                <p class="help is-danger">{{$errors->first('update_number_main_color')}}</p>
            @enderror

            <div class="field">
                <label for="update_number_url" class="label">URL</label>
                <div class="control">
                    <input class="input" type="text" placeholder="https://" value="{{ old('update_number_url', $number->url) }}" name="update_number_url" id="update_number_url">
                </div>
            </div>

            @error('update_number_url')
                <p class="help is-danger">{{$errors->first('update_number_url')}}</p>
            @enderror

            <div class="field">
                <input type="checkbox" value="1" name="update_number_shortize" id="update_number_shortize" @if (old('update_number_shortize') === 1 || $number->shortize === 1) checked="checked" @endif>
                <label for="update_number_shortize" class="checkbox">Reduce the block size if too large?</label>
            </div>

            <div class="field">
                <input type="checkbox" value="1" name="update_number_hide_number" id="update_number_hide_number" @if (old('update_number_hide_number') === 1 || $number->hide_number === 1) checked="checked" @endif>
                <label for="update_number_hide_number" class="checkbox">Hide the number label from the board</label>
            </div>

            <div class="field is-grouped">
                <div class="control">
                    <input type="submit" value="Update" class="button is-link">
                </div>
                <div class="control">
                    <a href="{{ route('show_board', $board->id) }}" class="button is-link is-light">Back</a>
                </div>
            </div>
        </form>
    </div>

@endsection

