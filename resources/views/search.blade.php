@extends('layouts.webview')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div id="filter-wrapper" class="filter-wrapper left-filter-wrapper filter-canvas-wrapper filter-canvas-wrapper-left">                
                <a href="#" class="filter-close-menu"><i class="fas fa-angle-left"></i>{{ __("Back to Results") }}</a>
                <div class="filter-inner-wrapper">

                    <div class="filter-wrapper-unit">
                        <input id="estate_location" name="location" value="0" type="hidden">
                        <div class="filter-input">
                            <div class="value-wrapper"><i class="fas fa-map-marker-alt"></i><span class="default-label">{{ __("Any Location") }}</span><span class="custom-label"></span></div>
                            <div class="arrow-icon-wrapper">
                                <i class="fas fa-angle-down"></i>
                            </div>
                            <div class="dropdown-content transition-200">
                                <div class="filter-input-wrapper">
                                    <input id="location_keyword" class="location_keyword" type="text" placeholder='{{ __("Filter Locations") }}'>
                                </div>
                                <div class="filter-content-wrapper filter-content-location-default-wrapper">
                                    <ul>
                                        <li data-getchildren="1" class="location-all filter-switcher filter-location-switcher active" data-target="estate_location" data-id="0">
                                            <i class="far fa-square"></i>
                                            <i class="far fa-check-square"></i>
                                            {{ __("All Locations") }}
                                        </li>
                                        @foreach ($locations as $location)
                                            <li data-getchildren="1" class="filter-switcher filter-location-switcher" data-label='{{ $location["name"] }}' data-target="estate_location" data-id='{{ $location["id"] }}'>
                                                <i class="far fa-square"></i>
                                                <i class="far fa-check-square"></i>
                                                {{ $location["name"] }}
                                            </li>                            
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="child-location-wrapper"></div>
                    </div>
                    
                    <div class="filter-label-wrapper ">
                        <label>{{ __("Property Type") }}</label>
                    </div>
            
                    <div class="filter-wrapper-unit ">
                        <input id="estate_property_type" value="0" type="hidden">
                        <div class="filter-input">
                            <div class="value-wrapper">
                                <i class="fas fa-home"></i><span class="default-label">{{ __("Any Type") }}</span><span class="custom-label"></span>
                            </div>
                            <div class="arrow-icon-wrapper">
                                <i class="fas fa-angle-down"></i>
                            </div>
                            <div class="dropdown-content transition-200">
                                <div class="filter-content-wrapper">
                                    <ul>
                                        <li class="filter-switcher active" data-target="estate_property_type" data-id="0">
                                            <i class="far fa-square"></i>
                                            <i class="far fa-check-square"></i>
                                            {{ __("All Property Types") }}
                                        </li>
                                        @foreach ($propertyTypes as $propertyType)
                                            <li data-id="{{ $propertyType['id'] }}" data-target="estate_property_type" data-label='{{ $propertyType["title"] }}' class="filter-switcher">
                                                <i class="far fa-square"></i>
                                                <i class="far fa-check-square"></i>
                                                {{ $propertyType["title"] }}
                                            </li>
                                        @endforeach
                                    </ul>    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="filter-label-wrapper ">
                        <label>Property Status</label>
                    </div>
            
                    <div class="filter-wrapper-unit ">
                        <input id="estate_property_status" value="0" type="hidden">
                        <div class="filter-input">
                            <div class="value-wrapper"><i class="far fa-bell"></i><span class="default-label">{{ __("Any Status") }}</span><span class="custom-label"></span></div>
                            <div class="arrow-icon-wrapper">
                                <i class="fas fa-angle-down"></i>
                            </div>
                            <div class="dropdown-content transition-200">
                                <div class="filter-content-wrapper">
                                    <ul>
                                        <li class="filter-switcher active" data-target="estate_property_status" data-id="0">
                                            <i class="far fa-square"></i>
                                            <i class="far fa-check-square"></i>
                                            {{ __("Any Status") }}
                                        </li>
                                        @foreach ($propertyStatus as $propertyStatusItem)
                                            <li data-id="{{ $propertyStatusItem['id'] }}" data-target="estate_property_status" data-label='{{ $propertyStatusItem["title"] }}' class="filter-switcher">
                                                <i class="far fa-square"></i>
                                                <i class="far fa-check-square"></i>
                                                {{ $propertyStatusItem["title"] }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <div class="filter-label-wrapper ">
                        <label>Price Range</label>
                    </div>
            
                    <div class="filter-wrapper-unit ">
                        <div class="filter-col-left">
                            <div class="filter-input filter-min-price-input">
                                <div class="value-wrapper"><span class="default-label">Any Price</span><span class="custom-label"></span></div>
                                <div class="arrow-icon-wrapper">
                                    <i class="fa fa-angle-down"></i>
                                </div>
                                <div class="dropdown-content transition-200">
                                    <div class="filter-input-wrapper">
                                        <input id="property_filter_min_price" class="filter-element range-value-input price-range" data-target="filter-min-price-input" type="text" placeholder="Min Price">
                                    </div>
                                    <div class="filter-content-wrapper">
                                        <div class="filter-content-title">Minimum</div>
                                        <div class="filter-content-content">$ 1,001</div>
                                    </div>
                                    <div class="filter-content-wrapper">
                                        <div class="filter-content-title">Avarage</div>
                                        <div class="filter-content-content">$ 2,228,291</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter-col-right">
                            <div class="filter-input filter-max-price-input">
                                <div class="value-wrapper"><span class="default-label">Any Price</span><span class="custom-label"></span></div>
                                <div class="arrow-icon-wrapper">
                                    <i class="fa fa-angle-down"></i>
                                </div>
                                <div class="dropdown-content transition-200">
                                    <div class="filter-input-wrapper">
                                        <input id="property_filter_max_price" class="filter-element range-value-input price-range" data-target="filter-max-price-input" type="text" placeholder="Max Price">
                                    </div>
                                    <div class="filter-content-wrapper">
                                        <div class="filter-content-title">Maximum</div>
                                        <div class="filter-content-content">
                                            $                        20,000,001                                            </div>
                                    </div>
                                    <div class="filter-content-wrapper">
                                        <div class="filter-content-title">Avarage</div>
                                        <div class="filter-content-content">$ 2,228,291</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="filter-label-wrapper ">
                        <label>Area Range</label> <span class="filter-label-range"><span id="estate_area_range_min">0</span>m<sup>2</sup> - <span id="estate_area_range_max">10,000</span>m<sup>2</sup></span>
                    </div>
            
                    <div class="filter-wrapper-unit ">
                        <input id="estate_area" value="0,10000" type="hidden">
                        <div class="filter-value-range" id="filter-value-range-area" type="hidden" data-target="estate_area" data-postfix="m<sup>2</sup>" data-start="0" data-end="10000">
                        </div>
                    </div>
            
                    <div class="filter-label-wrapper filter-wrapper-extra-padding ">
                        <label>Indoor Features</label>
                    </div>
            
                    <div class="filter-wrapper-unit">
                        <input id="estate_interior_features" value="" type="hidden">
                        <div class="filter-content-wrapper filter-content-wrapper-multiple filter-wrapper-unit-scrollable">
                            <ul>
                                <li class="filter-switcher-multiple estate_interior_features active default-switch" data-target="estate_interior_features" data-id="0">
                                    <i class="far fa-square"></i>
                                    <i class="far fa-check-square"></i>
                                    {{ __("All Features") }}
                                </li>
                                @foreach ($interiorFeatures as $interiorFeature)
                                    <li class="filter-switcher-multiple estate_interior_features" data-target="estate_interior_features" data-id="{{ $interiorFeature['id'] }}">
                                        <i class="far fa-square"></i>
                                        <i class="far fa-check-square"></i>
                                        {{ $interiorFeature["title"] }}
                                    </li>                
                                @endforeach
                            </ul>
                        </div>
                    </div>
            
                    <div class="filter-label-wrapper ">
                        <label>{{ __("Outdoor Features") }}</label>
                    </div>
            
                    <div class="filter-wrapper-unit ">
                        <input id="estate_exterior_features" value="" type="hidden">
                        <div class="filter-content-wrapper filter-content-wrapper-multiple filter-wrapper-unit-scrollable">
                            <ul>
                                <li class="filter-switcher-multiple estate_exterior_features active default-switch" data-target="estate_exterior_features" data-id="0">
                                    <i class="far fa-square"></i>
                                    <i class="far fa-check-square"></i>
                                    {{ __("All Features") }}
                                </li>
                                @foreach ($exteriorFeatures as $exteriorFeature)
                                    <li class="filter-switcher-multiple estate_exterior_features" data-target="estate_exterior_features" data-id="{{ $exteriorFeature['id'] }}">
                                        <i class="far fa-square"></i>
                                        <i class="far fa-check-square"></i>
                                        {{ $exteriorFeature["title"] }}
                                    </li>                
                                @endforeach
                            </ul>
                        </div>
                    </div>
            
                    <div class="filter-label-wrapper ">
                        <label>Number of Rooms</label><div class="filter-label-range">Between <span id="estate_number_of_rooms_range_min">0</span> - <span id="estate_number_of_rooms_range_max">12</span> <span>Rooms</span></div>
                    </div>
            
                    <div class="filter-wrapper-unit filter-wrapper-range-wrapper ">
                        <input id="estate_number_of_rooms" value="0,12" type="hidden">
                        <div class="filter-value-range" id="filter-value-range-room" type="hidden" data-target="estate_number_of_rooms" data-start="0" data-end="12">
                        </div>
                    </div>
            
                    <div class="filter-wrapper-unit filter-wrapper-selection ">
                        <input id="estate_number_of_bathrooms" value="0" type="hidden">
                        <div class="filter-content-wrapper filter-content-wrapper-multiple">
                            <ul>
                                <li class="filter-switcher-multiple estate_number_of_bathrooms" data-target="estate_number_of_bathrooms" data-id="1">
                                    <i class="far fa-square"></i>
                                    <i class="far fa-check-square"></i>
                                    {{ __("More Than One Bathrooms") }}
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="filter-label-wrapper ">
                        <label>Address</label>
                    </div>
            
                    <div class="filter-wrapper-unit ">
                        <input id="estate_address" class="filter-value filter-element" type="text" data-start="" value="" placeholder="Search for Property Address">
                    </div>
            
                    <div class="filter-label-wrapper ">
                        <label>{{ __("Floor") }}</label> 
                        <span class="filter-label-range">
                            <span>{{ __("Between") }}</span> 
                            <span id="estate_floor_range_min">0</span> 
                            - <span id="estate_floor_range_max">10</span> 
                            <span>{{ __("Floors") }}</span>
                        </span>
                    </div>
                    <div class="filter-wrapper-unit ">
                        <input id="estate_floor" value="0,10" type="hidden">
                        <div class="filter-value-range" id="filter-value-range-floor" type="hidden" data-target="estate_floor" data-start="0" data-end="10">
                        </div>
                    </div>

                    <div class="filter-wrapper-unit filter-wrapper-selection ">
                        <input id="estate_has_park_area" value="0" type="hidden">
                        <div class="filter-content-wrapper filter-content-wrapper-multiple">
                            <ul>
                                <li class="filter-switcher-multiple estate_has_park_area" data-target="estate_has_park_area" data-id="1">
                                    <i class="far fa-square"></i>
                                    <i class="far fa-check-square"></i>
                                    {{ __("Has Park Area") }}
                                </li>
                            </ul>
                        </div>
                        <input id="estate_has_garden" value="0" type="hidden">
                        <div class="filter-content-wrapper filter-content-wrapper-multiple">
                            <ul>
                                <li class="filter-switcher-multiple estate_has_garden" data-target="estate_has_garden" data-id="1">
                                    <i class="far fa-square"></i>
                                    <i class="far fa-check-square"></i>
                                    {{ __("Has Garden") }}
                                </li>
                            </ul>
                        </div>
                    </div>

                    
            
                    <div class="filter-label-wrapper ">
                        <label>Keyword</label>
                    </div>
            
                    <div class="filter-wrapper-unit ">
                        <input id="estate_keyword" class="filter-value filter-element" type="text" data-start="" value="" placeholder="Search Keyword in Details">
                    </div>
            
                    <div class="filter-label-wrapper filter-wrapper-extra-padding ">
                        <label>{{ __("Age of Building") }}</label>
                        <div class="filter-label-range">
                            {{ __("Between") }} 
                            <span id="estate_age_of_building_range_min">0</span> 
                            - <span id="estate_age_of_building_range_max">94</span> 
                            <span>{{ __("Years") }} </span>
                        </div>
                    </div>         
                    <div class="filter-wrapper-unit ">
                        <input id="estate_age_of_building" value="0,94" type="hidden">
                        <div class="filter-value-range" id="filter-value-range-age" type="hidden" data-target="estate_age_of_building" data-start="0" data-end="94">
                        </div>
                    </div>
                </div>
            </div> <!-- End of filter -->
            <div class="property-list-wrapper">
                <div class="filter-wrapper top-filter">
                    <div class="header-handler">
                        <span class="order-label">{{ __("Recent Properties") }}</span> <i>in</i> <span class="location-label">{{ __("All Locations") }}</span>
                    </div>
                    <div class="map-handler-wrapper">
                        <div class="map-handler" data-map="top"><i class="fa fa-map-o"></i> Show Map</div>
                    </div>
                    <div class="order-filter-wrapper">
                        <div class="filter-wrapper-unit ">
                            <input id="list_order" name="order" value="date,DESC" type="hidden">
                            <div class="filter-input">
                                <div class="value-wrapper"><i class="fa fa-sort-amount-desc"></i><span class="default-label">Recent First</span><span class="custom-label"></span></div>
                                <div class="arrow-icon-wrapper">
                                    <i class="fa fa-angle-down"></i>
                                </div>
                                <div class="dropdown-content orderby-dropdown transition-200">
                                    <div class="filter-content-wrapper">
                                        <ul>
                                            <li data-id="date,DESC" class="filter-switcher filter-order-switcher active" data-target="estate_order">Recent First</li><li data-id="date,ASC" class="qual-filter-switcher qual-filter-order-switcher " data-target="estate_order">Ascending Date</li><li data-id="price,ASC" class="qual-filter-switcher qual-filter-order-switcher " data-target="estate_order">Ascending Price</li><li data-id="price,DESC" class="qual-filter-switcher qual-filter-order-switcher " data-target="estate_order">Descending Price</li><li data-id="title,ASC" class="qual-filter-switcher qual-filter-order-switcher " data-target="estate_order">Alphabetic Order</li><li data-id="title,DESC" class="qual-filter-switcher qual-filter-order-switcher " data-target="estate_order">Reverse Alphabetic</li>                </ul>
                                    </div>
                                    <div class="filter-content-wrapper filter-content-location-wrapper uptown-hidden"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="property-results-loading"><i class="fas fa-spinner spin"></i>{{ __("Loading search results...") }}</div>
                <div id="estate-map-content">
                    <div class="estate-mappable"></div>
                </div>
                <div id="property_results" class="property-list">
                    @foreach($initialProperties AS $property)
                        <x-property :property="$property" :rows="3" />
                    @endforeach
                </div>    
            </div> <!-- Property results -->
        </div>
    </div>
</div>
@endsection
