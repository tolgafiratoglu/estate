<article class="property-list-item row-3">
    <div class="featured-image-wrapper">
        <a href="{{ url('property', $property['slug']) }}">
            @if(array_key_exists('featured_image_folder', $property) && $property['featured_image_folder'] != NULL)
                <img src="{{ asset($property['featured_image_folder'].$property['feature_image_file_name']) }}">
            @else
                <div class="no-image"></div>
            @endif                            
        </a>
    </div>
    <div class="property-details">
        <h4>
            <a data-browser="url" class="" href="{{ url('property', $property['slug']) }}">
                {{ $property["property_title"] }}             
            </a>
        </h4>
        <div class="address">
            {{ $property["address"] }}                    
        </div>
        <div class="info">
            <i class="fa fa-object-ungroup"></i> <span class="property-area">{{ $property["area"] }} m<sup>2</sup></span> /  <i class="fa fa-bed"></i> <span class="property-rooms">{{ $property["number_of_rooms"] }}</span> Rooms                    
        </div>
    </div>
    <div class="property-bottom">
        <div class="property-location">
            <i class="fa fa-map-marker"></i> {{ $property["location_name"] }}                    
        </div>
        <div class="property-price">
            ${{ number_format($property["price"]) }}                                                    
        </div>
    </div>    
</article>