<article class="property-list-item row-{{ $rows }}">
    <div class="featured-image-wrapper">
        <a href="{{ url('project', $project['slug']) }}">
            @if(array_key_exists('featured_image_folder', $project) && $project['featured_image_folder'] != NULL)
                <img src="{{ asset($project['featured_image_folder'].$project['feature_image_file_name']) }}">
            @else
                <div class="no-image"></div>
            @endif                            
        </a>
    </div>
    <div class="property-details">
        <h4>
            <a data-browser="url" class="" href="{{ url('project', $project['slug']) }}">
                {{ $project["project_title"] }}             
            </a>
        </h4>
        <div class="info">
            <i class="fa fa-object-ungroup"></i> <span class="property-area">{{ $project["number_of_properties"] }} m<sup>2</sup></span> /  <i class="fa fa-bed"></i> <span class="property-rooms">{{ $project["min_number_of_rooms"] }}</span> Rooms                    
        </div>
    </div>
    <div class="property-bottom">
        <div class="property-location">
            <i class="fa fa-map-marker"></i> {{ $project["location_name"] }}                    
        </div>
        <div class="property-price">
            <span class="currency">$</span>{{ $project["project_title"] }}                                                    
        </div>
    </div>    
</article>