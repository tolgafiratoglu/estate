@extends('layouts.admin')

@section('content')
    <input type="hidden" id="item_id" value='{{ !$new ? $data["id"] : 0 }}'>
    <div class="alert-warning-wrapper d-none alert alert-warning" role="alert"></div>
    <div class="form-group">
        <label for="property_status_title">{{ __('admin.property_status') }}</label>
        <input type="text" value='{{ !$new ? $data["title"] : "" }}' class="form-control" id="property_status_title" aria-describedby="propertyStatusHelp" placeholder="{{ __('admin.should_not_be_empty') }}">
        <small id="propertyStatusHelp" class="form-text text-muted">{{ __('admin.property_status_detail') }}</small>
    </div>
    <div class="form-group">
        <label for="property_status_title">{{ __('admin.property_status_slug') }}</label>
        <input type="text" value='{{ !$new ? $data["slug"] : "" }}' class="form-control" id="property_status_slug" aria-describedby="propertyStatusHelp" placeholder="{{ __('admin.optional') }}">
        <small id="propertyStatusHelp" class="form-text text-muted">{{ __('admin.property_status_slug_detail') }}</small>
    </div>
    <button type="submit" class="admin-property-status-save btn btn-primary">Submit</button>
@endsection
