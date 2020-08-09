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
            <div class="estate-infocard">
                <div class="estate-infocard-cell">
                    <div class="estate-infocard-row-left">{{ __("Property Area") }}</div>
                    <div class="estate-infocard-row-right">201 m<sup>2</sup></div>
                </div>
                <div class="estate-infocard-cell">
                    <div class="estate-infocard-row-left">{{ __("Price") }}</div>
                    <div class="estate-infocard-row-right">1,001$</div>
                </div>
                <div class="estate-infocard-cell">
                    <div class="estate-infocard-row-left">{{ __("Rooms") }}</div>
                    <div class="estate-infocard-row-right">3</div>
                </div>
                <div class="estate-infocard-cell">
                    <div class="estate-infocard-row-left">{{ __("Bathrooms") }}</div>
                    <div class="estate-infocard-row-right">0</div>
                </div>
                <div class="estate-infocard-cell">
                    <div class="estate-infocard-row-left">{{ __("Age of Building") }}</div>
                    <div class="estate-infocard-row-right">5</div>
                </div>
                <div class="estate-infocard-cell">
                    <div class="estate-infocard-row-left">{{ __("Floor") }}</div>
                    <div class="estate-infocard-row-right">5</div>
                </div>
            </div>
            <div class="estate-info-wrapper">
                <div class="estate-header">
                    <div class="svg-wrapper">
                        <i class="details-icon far fa-bookmark"></i>
                    </div>{{ __("Details") }}
                </div>
                <div class="estate-detail-content">
                    <p>{{ $property["description"] }}</p>
                </div>
            </div>
            <div class="estate-infocard">
                <div class="property-feature-div">
                    <h3>{{ __("Outdoor Features") }}</h3>
                    @foreach($exteriorFeatures AS $exteriorFeature)
                        <span class="property-feature"><i class="far fa-check-square"></i>{{ __($exteriorFeature["feature_title"]) }}</span>     
                    @endforeach
                </div>
            </div>
            <div class="estate-infocard">
                <div class="property-feature-div">
                    <h3>{{ __("Indoor Features") }}</h3>
                    @foreach($interiorFeatures AS $interiorFeature)
                        <span class="property-feature"><i class="far fa-check-square"></i>{{ __($interiorFeature["feature_title"]) }}</span>     
                    @endforeach
                </div>
            </div>
            <div class="estate-info-wrapper">
                <div class="estate-header">
                    <div class="svg-wrapper">
                        <i class="map-icon fas fa-map-marker-alt"></i>
                    </div>{{ __("Location") }}
                </div>
                <div class="estate-mappable estate-single-map" data-lat='{{ $property["lat"] }}' data-lng='{{ $property["lon"] }}' data-zoom="15"></div>
            </div> 
        </div>
        <div class="col-md-3">
           
        </div>
    </div>    
</div>
@endsection