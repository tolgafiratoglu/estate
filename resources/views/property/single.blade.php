@extends('layouts.webview')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="property-title-wrapper">
                <h1>{{ $property["property_title"] }}</h1>
            </div>
            @if($property["address"] != "")
                <div class="property-address-wrapper">
                    <i class="fa fa-map-marker"></i>{{ $property["address"] }}                     
                </div>
            @endif
            <div class="qual-uptown-slider-wrapper">
                <ul class="qual-light-slider">
                    @foreach($propertyImages AS $propertyImage)
                        <li data-thumb="{{ asset($propertyImage['folder'].'thumb/'.$propertyImage['file_name']) }}">
                            <img src="{{ asset($propertyImage['folder'].'large/'.$propertyImage['file_name']) }}">
                        </li>
                    @endforeach    
                </ul>
            </div>
        </div>
        <div class="col-md-3">
           
        </div>
    </div>    
</div>
@endsection