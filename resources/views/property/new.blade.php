@extends('layouts.webview')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="boxed-content shadowed-content rounded-border">
                <form>
                    <div class="form-group">
                        <label for="title_input">{{ __("Title") }}</label>
                        <input type="text" class="form-control" id="title_input" aria-describedby="titleHelp" placeholder='{{ __("Title of the property") }}'>
                        <small id="titleHelp" class="form-text text-muted">{{ __('Title will appear in search results, keep it explanatory.') }}</small>
                    </div>
                    <div class="form-group">
                        <label for="title_input">{{ __("Description") }}</label>
                        <textarea rows="5" type="text" class="form-control" id="title_input" aria-describedby="titleHelp" placeholder='{{ __("Title of the property") }}'></textarea>
                        <small id="titleHelp" class="form-text text-muted">{{ __('Description of the property, for customer friendly information.') }}</small>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <label for="price_input">{{ __("Price") }}</label>
                            <input type="text" class="form-control" id="price_input" aria-describedby="priceHelp" placeholder='{{ __("Price") }}'>
                        </div>
                        <div class="col-sm">
                            <label for="area_input">{{ __("Area") }}</label>
                            <input type="text" class="form-control" id="area_input" aria-describedby="areaHelp" placeholder='{{ __("Area") }}'>
                        </div>
                        <div class="col-sm">
                            <label for="number_of_rooms_input">{{ __("Number of Rooms") }}</label>
                            <select class="custom-select">
                                @for ($i = 1; $i < 50; $i++)
                                    <option value="{{ $i }}">{{ $i }} @if($i == 1){{ __('Room') }}@else{{ __('Rooms') }}@endif</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <label for="number_of_rooms_input">{{ __("Number of Bathrooms") }}</label>
                            <select class="custom-select">
                                @for ($i = 1; $i < 50; $i++)
                                    <option value="{{ $i }}">{{ $i }} @if($i == 1){{ __('Bathroom') }}@else{{ __('Bathrooms') }}@endif</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-sm">
                            <label for="number_of_rooms_input">{{ __("Age of Building") }}</label>
                            <select class="custom-select">
                                @for ($i = 1; $i < 50; $i++)
                                    <option value="{{ $i }}">{{ $i }} @if($i == 1){{ __('Year') }}@else{{ __('Years') }}@endif</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-sm">
                            <label for="number_of_rooms_input">{{ __("Number of Floors") }}</label>
                            <select class="custom-select">
                                @for ($i = 1; $i < 50; $i++)
                                    <option value="{{ $i }}">{{ $i }} @if($i == 1){{ __('Floor') }}@else{{ __('Floors') }}@endif</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>    
</div>
@endsection