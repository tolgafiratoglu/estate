@extends('layouts.admin')

@section('content')
    <div class="admin-content-table-wrapper">
        <div class="admin-settings-wrapper">
            <h1>{{ __("admin.defaults.context.units.header") }}</h1>
        </div>
        <div class="admin-settings-wrapper">    
            <div class="admin-setting-label">
                <span>{{ __("admin.defaults.context.units.measure") }}</span>
                <div class="d-none alert-icon alert-icon-loading">
                    <i class="fas fa-cog fa-spin"></i>
                </div>
                <div class="d-none alert-icon alert-icon-success">    
                    <i class="fas fa-check-circle"></i>
                </div>    
            </div>
            <div class="admin-setting-select-wrapper">
                <select class="form-control admin-setting-select" id="unit_measure" data-meta="units" data-key="measure">
                    <option value="meter">Meter</option>
                    <option value="mile">Mile</option>
                </select>
                <div class="d-none col-md-12 alert alert-danger mt-3" role="alert">
                    {{ __("admin.warnings.error") }}
                </div>
            </div>
        </div>
        <div class="admin-settings-wrapper">
            <div class="admin-setting-label">
                <span>{{ __("admin.defaults.context.units.currency") }}</span>    
                <div class="d-none alert-icon alert-icon-loading">
                    <i class="fas fa-cog fa-spin"></i>
                </div>
                <div class="d-none alert-icon alert-icon-success">    
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <div class="admin-setting-select-wrapper">
                <select class="form-control" id="currency_measure" data-meta="units" data-key="currency">
                    
                </select>
                <div class="d-none col-md-12 alert alert-danger mt-3" role="alert">
                    {{ __("admin.warnings.error") }}
                </div>
            </div>
        </div>
        <div class="admin-settings-wrapper">
            <h1>{{ __("admin.defaults.context.meta.header") }}</h1>
                @if(sizeof($systemDefaults["meta"]) > 0)
                    @foreach($systemDefaults["meta"] AS $systemDefault)
                        <div class="row admin-settings-wrapper admin-default-wrapper">
                            <div class="col-md-12 admin-setting-label">
                                <span>
                                    {{ __("admin.defaults.context.meta.".$systemDefault["key"]) }}
                                </span>
                                <div class="d-none alert-icon alert-icon-loading">
                                    <i class="fas fa-cog fa-spin"></i>
                                </div>
                                <div class="d-none alert-icon alert-icon-success">    
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="text" class="admin-default-value form-control mr-2" value='{{ __($systemDefault["value"]) }}' data-id='{{ __($systemDefault["id"]) }}' placeholder='{{ __("admin.defaults.context.meta.placeholder") }}' />
                                    <div class="input-group-btn">
                                        <button type="button" class="admin-default-save btn btn-primary">{{ __("admin.button.save") }}</button>
                                    </div><!-- /btn-group -->
                                    <div class="d-none col-md-12 alert alert-danger mt-3" role="alert">
                                        {{ __("admin.warnings.error") }}
                                    </div>
                                </div><!-- /input-group -->
                            </div><!-- /.col-md-12 -->
                            
                        </div><!-- /.row -->
                    @endforeach
                @endif    
        </div>
        <div class="admin-settings-wrapper">
            <h1>{{ __("admin.defaults.context.social_media.header") }}</h1>
                @if(sizeof($systemDefaults["social_media"]) > 0)
                    @foreach($systemDefaults["social_media"] AS $systemDefault)
                        <div class="row admin-settings-wrapper admin-default-wrapper">
                            <div class="col-md-12 admin-setting-label">
                                <span>
                                    {{ __("admin.defaults.context.social_media.".$systemDefault["key"]) }}
                                </span>
                                <div class="d-none alert-icon alert-icon-loading">
                                    <i class="fas fa-cog fa-spin"></i>
                                </div>
                                <div class="d-none alert-icon alert-icon-success">    
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="text" class="admin-default-value form-control mr-2" data-id='{{ __($systemDefault["id"]) }}' value='{{ __($systemDefault["value"]) }}' placeholder='{{ __("admin.defaults.context.social_media.placeholder") }}' />
                                    <div class="input-group-btn">
                                        <button type="button" class="admin-default-save btn btn-primary">{{ __("admin.button.save") }}</button>
                                    </div><!-- /btn-group -->
                                    <div class="d-none col-md-12 alert alert-danger mt-3" role="alert">
                                        {{ __("admin.warnings.error") }}
                                    </div>
                                </div><!-- /input-group -->
                            </div><!-- /.col-md-12 -->
                        </div><!-- /.row -->
                    @endforeach
                @endif    
        </div>      
    </div>    
@endsection