@extends('layouts.webview')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="latest-property-list-wrapper">
                <div class="latest-property-list-header">
                    <div class="latest-property-list-title">
                        {{ __("webview.home.latest_properties") }}
                    </div>
                    <div class="latest-property-list-search">
                        {{ __("webview.home.search") }}
                    </div>
                </div>
                @if(sizeof($latestProperties))
                    <div class="property-list">
                        @foreach($latestProperties AS $property)
                            <x-property :property="$property" rows="4" />
                        @endforeach    
                    </div>
                @endif   
            </div>

        </div>
    </div>
</div>
@endsection
