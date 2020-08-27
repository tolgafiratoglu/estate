@extends('layouts.webview')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="latest-property-list-wrapper">
                <div class="latest-property-list-header">
                    <div class="latest-property-list-title">
                        {{ __("Latest Properties") }}
                    </div>
                    <div class="latest-property-list-search">
                        {{ __("Search") }}
                    </div>
                </div>
                <div class="property-list">
                    @foreach($latestProperties AS $property)
                        <x-property :property="$property" rows="4" />
                    @endforeach    
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
