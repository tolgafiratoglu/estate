@foreach($searchResults AS $property)
    <x-property :property="$property" :rows="3" />
@endforeach