@extends('layouts.webview')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if($settings["show_latest_properties"] === 1 && sizeof($latestProperties) > 0)
                <div class="latest-list-wrapper">
                    <div class="latest-list-header">
                        <div class="latest-list-title">
                            {{ __("webview.home.latest_properties") }}
                        </div>
                        <div class="latest-list-search">
                            {{ __("webview.home.search") }}
                        </div>
                    </div>
                    <div class="property-list">
                        @foreach($latestProperties AS $property)
                            <x-property :property="$property" rows="4" />
                        @endforeach    
                    </div>
                </div>
            @endif
        </div>
        <div class="col-md-12">
            @if($settings["show_latest_projects"] === 1 && sizeof($latestProjects) > 0)
                <div class="latest-property-list-wrapper">
                    <div class="latest-property-list-header">
                        <div class="latest-property-list-title">
                            {{ __("webview.home.latest_properties") }}
                        </div>
                        <div class="latest-property-list-search">
                            {{ __("webview.home.search") }}
                        </div>
                    </div>
                    <div class="property-list">
                        @foreach($latestProjects AS $project)
                            <x-project :project="$project" rows="4" />
                        @endforeach    
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
