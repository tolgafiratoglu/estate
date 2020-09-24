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
                {{ \Illuminate\Support\Str::limit($project["project_title"], 20, '...') }}             
            </a>
        </h4>
        <div class="info">
            @if($project["number_of_properties"] > 0)
                <i class="fa fa-building"></i><span class="info-label">{{ $project["number_of_properties"] }} {{ __("Properties For Sale") }}</span>                    
            @endif
        </div>
    </div>
    <div class="property-bottom">
        <div class="property-location">
            <i class="fa fa-map-marker"></i> {{ $project["location_name"] }}                    
        </div>
        <div class="estimated-date">
            {{ date('F Y', strtotime($project["estimated_completion_date"])) }}                                                    
        </div>
    </div>    
</article>