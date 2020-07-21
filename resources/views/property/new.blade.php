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
                <form class="estate-new-form">
                    <div class="form-group">
                        <label for="title">{{ __("Title") }}</label>
                        <input type="text" class="form-control slug-trigger" id="title" name="title" data-context="property" aria-describedby="titleHelp" placeholder='{{ __("Title of the property") }}'>
                        <small id="titleHelp" class="form-text text-muted">{{ __('Title will appear in search results, keep it explanatory.') }}</small>
                    </div>
                    <div class="form-group">
                        <label for="slug">{{ __("Slug") }}</label>
                        <input type="text" class="form-control slug" id="slug" name="slug" aria-describedby="slugHelp" placeholder='{{ __("slug-of-the-property") }}'>
                        <small id="slugHelp" class="form-text text-muted">{{ __('Slug is the permalink of the property') }}</small>
                        <small id="slug_preview" class="slug-preview form-text"></small>
                        <small id="slug_link" class="slug-link form-text"></small>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <label for="property_type">{{ __("Property Types") }}</label>
                            <select class="custom-select" id="property_type" name="property_type">
                                @foreach($propertyTypes AS $propertyType)
                                    <option value='{{ $propertyType["id"] }}'>{{  __($propertyType["title"]) }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">{{ __('Shape of Property') }}</small>
                        </div>
                        <div class="col-sm">
                            <label for="property_status">{{ __("Property Status") }}</label>
                            <select class="custom-select" id="property_status" name="property_status">
                                @foreach($propertyStatus AS $propertyStatusItem)
                                    <option value='{{ $propertyStatusItem["id"] }}'>{{  __($propertyStatusItem["title"]) }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">{{ __('Why it is listed') }}</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __("Description") }}</label>
                        <textarea rows="5" type="text" class="form-control" id="description" aria-describedby="descriptionHelp" placeholder='{{ __("Description of the property") }}'></textarea>
                        <small id="descriptionHelp" class="form-text text-muted">{{ __('Description of the property, for customer friendly information.') }}</small>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <label for="price">{{ __("Price") }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="price" aria-describedby="priceHelp" placeholder='{{ __("Price") }}'>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="currency">$</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <label for="area">{{ __("Area") }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="area" aria-describedby="areaHelp" placeholder='{{ __("Area") }}'>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="area_unit">m<sup>2</sup></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <label for="year_built">{{ __("Year Built") }}</label>
                            <select class="custom-select" id="year_built" name="year_built">
                                @for ($i = date("Y"); $i > date("Y") - 300; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <label for="number_of_rooms">{{ __("Number of Rooms") }}</label>
                            <select class="custom-select" id="number_of_rooms" name="number_of_rooms">
                                @for ($i = 1; $i < 50; $i++)
                                    <option value="{{ $i }}">{{ $i }} @if($i == 1){{ __('Room') }}@else{{ __('Rooms') }}@endif</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-sm">
                            <label for="number_of_bathrooms">{{ __("Number of Bathrooms") }}</label>
                            <select class="custom-select" id="number_of_bathrooms" name="number_of_bathrooms">
                                @for ($i = 1; $i < 50; $i++)
                                    <option value="{{ $i }}">{{ $i }} @if($i == 1){{ __('Bathroom') }}@else{{ __('Bathrooms') }}@endif</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-sm">
                            <label for="number_of_rooms_input">{{ __("Which Floor?") }}</label>
                            <select class="custom-select" name="which_floor" id="which_floor">
                                @for ($i = -10; $i < 50; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <label for="number_of_rooms">{{ __("Number of Floors") }}</label>
                            <select class="custom-select" id="number_of_floors" name="number_of_floors">
                                @for ($i = 1; $i < 50; $i++)
                                    <option value="{{ $i }}">{{ $i }} @if($i == 1){{ __('Floor') }}@else{{ __('Floors') }}@endif</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-sm">
                            <label for="number_of_bathrooms">{{ __("Heating") }}</label>
                            <select class="custom-select" id="heating" name="heating">
                                @foreach($heatingOptions AS $heatingOption)
                                    <option value='{{ $heatingOption["id"] }}'>{{ __($heatingOption["title"]) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm">
                            <label for="number_of_rooms_input">{{ __("Cooling") }}</label>
                            <select class="custom-select">
                                @foreach($coolingOptions AS $coolingOption)
                                    <option value='{{ $coolingOption["id"] }}'>{{ __($coolingOption["title"]) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
                <div class="estate-info-title-wrapper">
                    <div class="estate-header">
                        <span class="estate-info-icon-wrapper">
                            <i class="fas fa-table"></i>
                        </span>
                        <span>{{ __("Location") }}</span>
                    </div>
                </div>
                <div class="estate-new-feature estate-location-wrapper">
                    <input type="hidden" id="estate_location" name="estate_location">
                    <select class="d-none estate-location-clonable estate-location w-25 custom-select">
                        <option value="0">{{ __("Select Location") }}</option>
                    </select>
                    <select class="estate-location w-25 custom-select">
                        <option value="0">{{ __("Select Location") }}</option>
                        @foreach($locations AS $location)
                            <option value='{{ $location["id"] }}'>{{ __($location["name"]) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="estate-info-title-wrapper">
                    <div class="estate-header">
                        <span class="estate-info-icon-wrapper">
                            <i class="fas fa-table"></i>
                        </span>
                        <span>{{ __("Parking & Garden") }}</span>
                    </div>
                </div>
                <div class="estate-new-feature">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="has_garden">
                        <label class="form-check-label" for="has_garden">{{ __("Has Garden") }}</label>
                    </div>
                </div>
                <div class="estate-new-feature estate-garden-area d-none">
                    <div class="form-group">
                            <label for="area">{{ __("Garden Area") }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="garden_area" name="garden_area" placeholder='{{ __("Garden Area") }}'>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="area_unit">m<sup>2</sup></span>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="estate-new-feature">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="has_park_space">
                        <label class="form-check-label" for="has_park_space">{{ __("Has Parking Areas") }}</label>
                    </div>
                </div>
                <div class="estate-new-feature estate-park-spaces d-none">
                    <div class="form-group">
                            <label for="area">{{ __("Number of Park Spaces") }}</label>
                            <select class="custom-select" id="number_of_park_spaces" name="number_of_park_spaces">
                                @for ($i = 1; $i < 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                    </div>
                </div>
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
                        <select id="interior_features" name="interior_features" class="custom-select chosen-selector" multiple>
                            @foreach($interiorFeatureOptions AS $interiorFeatureOption)
                                <option value='{{ $interiorFeatureOption["id"] }}'>{{  __($interiorFeatureOption["title"]) }}</option>
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
                        <select id="exterior_features" name="exterior_features"  class="custom-select chosen-selector" multiple>
                            @foreach($exteriorFeatureOptions AS $exteriorFeatureOption)
                                <option value='{{ $exteriorFeatureOption["id"] }}'>{{ __($exteriorFeatureOption["title"]) }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">{{ __('Exterior features of the property') }}</small>
                    </div>
                </div>
                <div class="estate-info-title-wrapper">
                    <div class="estate-header">
                        <span class="estate-info-icon-wrapper">
                            <i class="fas fa-table"></i>
                        </span>
                        <span>{{ __("View") }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <select id="view" name="view" class="custom-select chosen-selector" multiple>
                            @foreach($viewOptions AS $viewOption)
                                <option value='{{ $viewOption["id"] }}'>{{  __($viewOption["title"]) }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">{{ __('View of the property (e.g. seaside, mountainview)') }}</small>
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
                <div class="estate-new-feature">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="form_validation_check">
                        <label class="form-check-label" for="form_validation_check">{{ __("I accept terms about publishing a new property.") }}</label>
                    </div>
                </div>    
                <div class="save-button-wrapper">
                    <div class="save-button">{{ __("Save") }}</div>
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection