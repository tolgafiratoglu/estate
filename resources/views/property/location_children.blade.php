@if(sizeof($locations) > 0)
<div class="filter-wrapper-unit">
    <input id="estate_location" name="location" value="0" type="hidden">
    <div class="filter-input">
        <div class="value-wrapper"><i class="fas fa-map-marker-alt"></i><span class="default-label">{{ __("Districts of ").$parent_label }}</span><span class="custom-label"></span></div>
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
@endif