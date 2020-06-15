@extends('layouts.webview')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="qual-filter-canvas">
                            
                <div id="qual-filter-wrapper" class="qual-filter-wrapper qual-left-filter-wrapper qual-filter-canvas-wrapper qual-filter-canvas-wrapper-left">                
                    <a href="#" class="qual-uptown-close-menu"><i class="fa fa-angle-left"></i>Back to Results</a>
                    <div class="qual-filter-inner-wrapper">

                        <div class="qual-filter-wrapper-unit">
                            <input id="qual_location" name="location" value="0" type="hidden">
                            <div class="filter-input">
                                <div class="value-wrapper"><i class="fa fa-map-marker"></i><span class="default-label">Any Location</span><span class="custom-label"></span></div>
                                <div class="arrow-icon-wrapper">
                                    <i class="fa fa-angle-down"></i>
                                </div>
                                <div class="dropdown-content qual-transition-200">
                                    <div class="filter-input-wrapper">
                                        <input id="location_keyword" class="location_keyword" type="text" placeholder="Filter Locations">
                                    </div>
                                    <div class="filter-content-wrapper filter-content-location-default-wrapper">
                                        <ul>
                                            <li data-getchildren="1" class="qual-location-all qual-filter-switcher qual-filter-location-switcher active" data-target="qual_location" data-id="0">All Locations</li>
                                            @foreach ($locations as $location)
                                                <li data-getchildren="1" class="qual-filter-switcher qual-filter-location-switcher" data-target="qual_location" data-id="2">{{ $location["name"] }}</li>                            
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="qual-child-location-wrapper"></div>
                        </div>
                        
                        <div class="filter-label-wrapper ">
                            <label>Property Type</label>
                        </div>
                
                        <div class="qual-filter-wrapper-unit ">
                            <input id="qual_property_type" value="0" type="hidden">
                            <div class="filter-input">
                                <div class="value-wrapper"><i class="fa fa-home"></i><span class="default-label">Any Type</span><span class="custom-label"></span></div>
                                <div class="arrow-icon-wrapper">
                                    <i class="fa fa-angle-down"></i>
                                </div>
                                <div class="dropdown-content qual-transition-200">
                                    <div class="filter-content-wrapper">
                                        <ul>
                                            <li class="qual-filter-switcher active" data-target="qual_property_type" data-id="0">All Property Types</li>
                                            @foreach ($propertyTypes as $propertyType)
                                                <li data-id="{{ $propertyType['id'] }}" data-target="qual_property_type" class="qual-filter-switcher">{{ $propertyType["name"] }}</li>
                                            @endforeach
                                        </ul>    
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="filter-label-wrapper ">
                            <label>Property Status</label>
                        </div>
                
                        <div class="qual-filter-wrapper-unit ">
                            <input id="qual_property_status" value="0" type="hidden">
                            <div class="filter-input">
                                <div class="value-wrapper"><i class="fa fa-bell-o"></i><span class="default-label">Any Status</span><span class="custom-label"></span></div>
                                <div class="arrow-icon-wrapper">
                                    <i class="fa fa-angle-down"></i>
                                </div>
                                <div class="dropdown-content qual-transition-200">
                                    <div class="filter-content-wrapper">
                                        <ul>
                                            <li class="qual-filter-switcher active" data-target="qual_property_status" data-id="0">Any Status</li>
                                            <li data-id="4" data-target="qual_property_status" class="qual-filter-switcher">For Rent</li><li data-id="3" data-target="qual_property_status" class="qual-filter-switcher">For Sale</li>                </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        <div class="filter-label-wrapper ">
                            <label>Price Range</label>
                        </div>
                
                        <div class="qual-filter-wrapper-unit ">
                            <div class="filter-col-left">
                                <div class="filter-input filter-min-price-input">
                                    <div class="value-wrapper"><span class="default-label">Any Price</span><span class="custom-label"></span></div>
                                    <div class="arrow-icon-wrapper">
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                    <div class="dropdown-content qual-transition-200">
                                        <div class="filter-input-wrapper">
                                            <input id="property_filter_min_price" class="qual-filter-element qual-range-value-input qual-price-range" data-target="filter-min-price-input" type="text" placeholder="Min Price">
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
                                    <div class="dropdown-content qual-transition-200">
                                        <div class="filter-input-wrapper">
                                            <input id="property_filter_max_price" class="qual-filter-element qual-range-value-input qual-price-range" data-target="filter-max-price-input" type="text" placeholder="Max Price">
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
                            <label>Area Range</label> <span class="filter-label-range"><span id="qual_area_range_min">0</span>m<sup>2</sup> - <span id="qual_area_range_max">10,000</span>m<sup>2</sup></span>
                        </div>
                
                        <div class="qual-filter-wrapper-unit ">
                            <input id="qual_area" value="0,10000" type="hidden">
                            <div class="qual-value-range noUi-target noUi-ltr noUi-horizontal noUi-background" id="qual-value-range-area" type="hidden" data-target="qual_area" data-postfix="m<sup>2</sup>" data-start="0" data-end="10000"><div class="noUi-base"><div class="noUi-origin" style="left: 0%;"><div class="noUi-handle noUi-handle-lower"></div></div><div class="noUi-origin" style="left: 100%;"><div class="noUi-handle noUi-handle-upper"></div></div></div></div>
                        </div>
                
                        <div class="filter-label-wrapper qual-filter-wrapper-extra-padding ">
                            <label>Indoor Features</label>
                        </div>
                
                        <div class="qual-filter-wrapper-unit ">
                            <input id="qual_interior_features" value="" type="hidden">
                            <div class="filter-content-wrapper filter-content-wrapper-multiple qual-filter-wrapper-unit-scrollable">
                                <ul>
                                    <li class="qual-filter-switcher-multiple qual_interior_features active default-switch" data-target="qual_interior_features" data-id="0">All Features</li>
                                        <li class="qual-filter-switcher-multiple qual_interior_features" data-target="qual_interior_features" data-id="22">ADSL</li><li class="qual-filter-switcher-multiple qual_interior_features" data-target="qual_interior_features" data-id="9">Furniture</li><li class="qual-filter-switcher-multiple qual_interior_features" data-target="qual_interior_features" data-id="17">Heating</li><li class="qual-filter-switcher-multiple qual_interior_features" data-target="qual_interior_features" data-id="15">Kitchen</li><li class="qual-filter-switcher-multiple qual_interior_features" data-target="qual_interior_features" data-id="23">Library</li><li class="qual-filter-switcher-multiple qual_interior_features" data-target="qual_interior_features" data-id="16">TV</li>                </ul>
                            </div>
                        </div>
                
                        <div class="filter-label-wrapper ">
                            <label>Outdoor Features</label>
                        </div>
                
                        <div class="qual-filter-wrapper-unit ">
                            <input id="qual_exterior_features" value="" type="hidden">
                            <div class="filter-content-wrapper filter-content-wrapper-multiple qual-filter-wrapper-unit-scrollable">
                                <ul>
                                    <li class="qual-filter-switcher-multiple qual_interior_features active default-switch" data-target="qual_exterior_features" data-id="0">All Features</li>
                                        <li class="qual-filter-switcher-multiple qual_exterior_features" data-target="qual_exterior_features" data-id="20">Bus</li><li class="qual-filter-switcher-multiple qual_exterior_features" data-target="qual_exterior_features" data-id="12">Hospital</li><li class="qual-filter-switcher-multiple qual_exterior_features" data-target="qual_exterior_features" data-id="19">Metro</li><li class="qual-filter-switcher-multiple qual_exterior_features" data-target="qual_exterior_features" data-id="11">Police</li><li class="qual-filter-switcher-multiple qual_exterior_features" data-target="qual_exterior_features" data-id="10">School</li><li class="qual-filter-switcher-multiple qual_exterior_features" data-target="qual_exterior_features" data-id="18">University</li>                </ul>
                            </div>
                        </div>
                
                        <div class="filter-label-wrapper ">
                            <label>Number of Rooms</label><div class="filter-label-range">Between <span id="qual_number_of_rooms_range_min">0</span> - <span id="qual_number_of_rooms_range_max">12</span> <span>Rooms</span></div>
                        </div>
                
                        <div class="qual-filter-wrapper-unit filter-wrapper-range-wrapper ">
                            <input id="qual_number_of_rooms" value="0,12" type="hidden">
                            <div class="qual-value-range noUi-target noUi-ltr noUi-horizontal noUi-background" id="qual-value-range-room" type="hidden" data-target="qual_number_of_rooms" data-start="0" data-end="12"><div class="noUi-base"><div class="noUi-origin" style="left: 0%;"><div class="noUi-handle noUi-handle-lower"></div></div><div class="noUi-origin" style="left: 100%;"><div class="noUi-handle noUi-handle-upper"></div></div></div></div>
                        </div>
                
                        <div class="qual-filter-wrapper-unit qual-filter-wrapper-unit-bathroom ">
                            <input id="qual_number_of_bathrooms" value="0" type="hidden">
                            <div class="filter-content-wrapper filter-content-wrapper-multiple">
                                <ul>
                                    <li class="qual-filter-switcher-multiple qual_number_of_bathrooms" data-target="qual_number_of_bathrooms" data-id="1+">More Than One Bathrooms</li>
                                </ul>
                            </div>
                        </div>
                
                        <div class="filter-label-wrapper ">
                            <label>Address</label>
                        </div>
                
                        <div class="qual-filter-wrapper-unit ">
                            <input id="qual_address" class="qual-filter-value qual-filter-element" type="text" data-start="" value="" placeholder="Search for Property Address">
                        </div>
                
                        <div class="filter-label-wrapper ">
                            <label>Keyword</label>
                        </div>
                
                        <div class="qual-filter-wrapper-unit ">
                            <input id="qual_keyword" class="qual-filter-value qual-filter-element" type="text" data-start="" value="" placeholder="Search Keyword in Details">
                        </div>
                
                        <div class="filter-label-wrapper ">
                            <label>Which Floor?</label> <span class="filter-label-range"><span>Between</span> <span id="qual_floor_range_min">0</span> - <span id="qual_floor_range_max">10</span> <span>Floors</span></span>
                        </div>
                
                        <div class="qual-filter-wrapper-unit ">
                            <input id="qual_floor" value="0,10" type="hidden">
                            <div class="qual-value-range noUi-target noUi-ltr noUi-horizontal noUi-background" id="qual-value-range-floor" type="hidden" data-target="qual_floor" data-start="0" data-end="10"><div class="noUi-base"><div class="noUi-origin" style="left: 0%;"><div class="noUi-handle noUi-handle-lower"></div></div><div class="noUi-origin" style="left: 100%;"><div class="noUi-handle noUi-handle-upper"></div></div></div></div>
                        </div>
                
                        <div class="filter-label-wrapper qual-filter-wrapper-extra-padding ">
                            <label>Age of Building</label><div class="filter-label-range">Between <span id="qual_age_of_building_range_min">0</span> - <span id="qual_age_of_building_range_max">94</span> <span>Years</span></div>
                        </div>
                
                        <div class="qual-filter-wrapper-unit ">
                            <input id="qual_age_of_building" value="0,94" type="hidden">
                            <div class="qual-value-range noUi-target noUi-ltr noUi-horizontal noUi-background" id="qual-value-range-age" type="hidden" data-target="qual_age_of_building" data-start="0" data-end="94"><div class="noUi-base"><div class="noUi-origin" style="left: 0%;"><div class="noUi-handle noUi-handle-lower"></div></div><div class="noUi-origin" style="left: 100%;"><div class="noUi-handle noUi-handle-upper"></div></div></div></div>
                        </div>
                    </div>
                </div>            
            </div> <!-- End of filter -->
        </div>
    </div>
</div>
@endsection
