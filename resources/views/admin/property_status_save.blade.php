@extends('layouts.admin')

@section('content')
    <div class="form-group">
        <label for="property_status_name">{{ __('admin.property_status') }}</label>
        <input type="text" class="form-control" id="property_status_name" aria-describedby="propertyStatusHelp" placeholder="{{ __('admin.should_not_be_empty') }}">
        <small id="propertyStatusHelp" class="form-text text-muted">{{ __('admin.property_status_detail') }}</small>
    </div>
    <div class="form-group">
        <label for="property_status_name">{{ __('admin.property_status_slug') }}</label>
        <input type="text" class="form-control" id="property_status_slug" aria-describedby="propertyStatusHelp" placeholder="{{ __('admin.optional') }}">
        <small id="propertyStatusHelp" class="form-text text-muted">{{ __('admin.property_status_slug_detail') }}</small>
    </div>
    <button type="submit" class="admin-property-status-save btn btn-primary">Submit</button>
@endsection
