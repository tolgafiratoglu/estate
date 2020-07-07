@extends('layouts.webview')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="boxed-content shadowed-content rounded-border">
                <div class="estate-info-title-wrapper">
                    <div class="estate-header">
                        <span class="estate-info-icon-wrapper">
                            <i class="far fa-building"></i>
                        </span>
                        <span>{{ __("Property Information") }}</span>
                    </div>
                </div>
                <div class="estate-new-feature">
                    <div class="image-upload-button-wrapper">
                        <div id="image-upload-select-button" class="image-upload-button image-upload-button-select">
                            {{ __("Select and Upload") }}
                        </div>
                        <input id="image_upload_file_handler" class="image-upload-file-handler" type="file" name="file_handler" multiple />
                    </div>
                    <div class="estate-image-label">
                        <i class="fas fa-arrows-alt"></i>{{ __("You can order images by drag and drop") }}
                    </div>
                    <div class="estate-images">
                        <input type="hidden" id="featured_image_id" value="">
                        <div class="estate-image-wrapper estate-image-clonable d-none">
                            <input type="hidden" id="media_id" name="estate_images[]" value="">
                            <div class="estate-image-left">
                                <img src="">
                            </div>
                            <div class="estate-image-right">
                                <h1></h1>
                                <ul>
                                    <li class="estate-remove"><i class="far fa-trash-alt"></i>{{ __("Remove") }}</li>
                                    <li class="estate-featured"><i class="far fa-images"></i>{{ __("Set as featured") }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="estate-new-feature">
                    <div class="form-group">
                        <label for="title_input">{{ __("Title") }}</label>
                        <input type="text" class="form-control slug-trigger" id="title_input" data-context="property" aria-describedby="titleHelp" placeholder='{{ __("Title of the property") }}'>
                        <small id="titleHelp" class="form-text text-muted">{{ __('Title will appear in search results, keep it explanatory.') }}</small>
                    </div>
                    <div class="form-group">
                        <label for="slug_input">{{ __("Slug") }}</label>
                        <input type="text" class="form-control slug" id="title_input" aria-describedby="slugHelp" placeholder='{{ __("slug-of-the-property") }}'>
                        <small id="slugHelp" class="form-text text-muted">{{ __('Slug is the permalink of the property') }}</small>
                        <small id="slug_preview" class="slug-preview form-text"></small>
                        <small id="slug_link" class="slug-link form-text"></small>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <label for="number_of_rooms_input">{{ __("Property Types") }}</label>
                            <select class="custom-select">
                                @foreach($propertyTypes AS $propertyType)
                                    <option value='{{ $propertyType["id"] }}'>{{ $propertyType["name"] }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">{{ __('Shape of Property') }}</small>
                        </div>
                        <div class="col-sm">
                            <label for="number_of_rooms_input">{{ __("Property Status") }}</label>
                            <select class="custom-select">
                                @foreach($propertyStatus AS $propertyStatusItem)
                                    <option value='{{ $propertyStatusItem["id"] }}'>{{ $propertyStatusItem["name"] }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">{{ __('Why it is listed') }}</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title_input">{{ __("Description") }}</label>
                        <textarea rows="5" type="text" class="form-control" id="title_input" aria-describedby="titleHelp" placeholder='{{ __("Title of the property") }}'></textarea>
                        <small id="titleHelp" class="form-text text-muted">{{ __('Description of the property, for customer friendly information.') }}</small>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <label for="price_input">{{ __("Price") }}</label>
                            <input type="text" class="form-control" id="price_input" aria-describedby="priceHelp" placeholder='{{ __("Price") }}'>
                        </div>
                        <div class="col-sm">
                            <label for="area_input">{{ __("Area") }}</label>
                            <input type="text" class="form-control" id="area_input" aria-describedby="areaHelp" placeholder='{{ __("Area") }}'>
                        </div>
                        <div class="col-sm">
                            <label for="number_of_rooms_input">{{ __("Number of Rooms") }}</label>
                            <select class="custom-select">
                                @for ($i = 1; $i < 50; $i++)
                                    <option value="{{ $i }}">{{ $i }} @if($i == 1){{ __('Room') }}@else{{ __('Rooms') }}@endif</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <label for="number_of_rooms_input">{{ __("Number of Bathrooms") }}</label>
                            <select class="custom-select">
                                @for ($i = 1; $i < 50; $i++)
                                    <option value="{{ $i }}">{{ $i }} @if($i == 1){{ __('Bathroom') }}@else{{ __('Bathrooms') }}@endif</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-sm">
                            <label for="number_of_rooms_input">{{ __("Age of Building") }}</label>
                            <select class="custom-select">
                                @for ($i = 1; $i < 50; $i++)
                                    <option value="{{ $i }}">{{ $i }} @if($i == 1){{ __('Year') }}@else{{ __('Years') }}@endif</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-sm">
                            <label for="number_of_rooms_input">{{ __("Number of Floors") }}</label>
                            <select class="custom-select">
                                @for ($i = 1; $i < 50; $i++)
                                    <option value="{{ $i }}">{{ $i }} @if($i == 1){{ __('Floor') }}@else{{ __('Floors') }}@endif</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </form>
                <div class="estate-info-title-wrapper">
                    <div class="estate-header">
                        <span class="estate-info-icon-wrapper">
                            <i class="fas fa-table"></i>
                        </span>
                        <span>{{ __("Custom Feature") }}</span>
                    </div>
                </div>
                <div class="estate-new-feature estate-custom-variables">
                    <table class="table">
                        <tbody>
                            <tr class="clonable d-none">
                                <td>
                                    <input type="text" class="form-control" placeholder='{{ __("Custom Label") }}'>
                                </td>
                                <td>
                                    <input type="text" class="form-control" placeholder='{{ __("Custom Feature Value") }}'>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" placeholder='{{ __("Custom Label") }}'>
                                </td>
                                <td>
                                    <input type="text" class="form-control" placeholder='{{ __("Custom Feature Value") }}'>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="custom-variable-add-row btn btn-info"><i class="fas fa-plus"></i>{{ __("Add Custom Feature") }}</button>
                </div>
                <div class="estate-info-title-wrapper">
                    <div class="estate-header">
                        <span class="estate-info-icon-wrapper">
                            <i class="fas fa-table"></i>
                        </span>
                        <span>{{ __("Interior Features") }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <select class="custom-select chosen-selector" multiple>
                            @foreach($propertyTypes AS $propertyType)
                                <option value='{{ $propertyType["id"] }}'>{{ $propertyType["name"] }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">{{ __('Interior features of the property') }}</small>
                    </div>
                </div>
                <div class="estate-info-title-wrapper">
                    <div class="estate-header">
                        <span class="estate-info-icon-wrapper">
                            <i class="fas fa-table"></i>
                        </span>
                        <span>{{ __("Exterior Features") }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <select class="custom-select chosen-selector" multiple>
                            @foreach($propertyTypes AS $propertyType)
                                <option value='{{ $propertyType["id"] }}'>{{ $propertyType["name"] }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">{{ __('Exterior features of the property') }}</small>
                    </div>
                </div>
                <div class="estate-info-title-wrapper">
                    <div class="estate-header">
                        <span class="estate-info-icon-wrapper">
                            <i class="fas fa-map"></i>
                        </span>
                        <span>{{ __("Property on Map") }}</span>
                    </div>
                </div>
                <div class="estate-new-feature">
                    <input type="hidden" id="lat_value" name="lat_value" value="">
                    <input type="hidden" id="lng_value" name="lng_value" value="">
                    <input type="hidden" id="zoom_value" name="zoom_value" value="">
                    <input type="text" id="map_search_keyword">
                    <div class="estate-mappable clickable-map" data-show="1" data-lat="0" data-lng="0" data-zoom="11"></div>
                </div>
                <div class="estate-info-title-wrapper">
                    <div class="estate-header">
                        <span class="estate-info-icon-wrapper">
                            <i class="far fa-images"></i>
                        </span>
                        <span>{{ __("Property Images") }}</span>
                    </div>
                </div>
                
            </div>
        </div>
    </div>    
</div>
@endsection