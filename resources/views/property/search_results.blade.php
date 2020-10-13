@if(count($searchResults) == 0)
    <div class="property-search-result"><i class="far fa-list-alt"></i>{{ __("No Results Found") }}</div>
@endif
@foreach($searchResults AS $property)
    <x-property :property="$property" :rows="3" />
@endforeach