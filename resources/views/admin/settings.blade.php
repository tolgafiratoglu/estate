@extends('layouts.admin')

@section('content')
    <div class="admin-content-table-wrapper">
        @foreach($systemSettings AS $context=>$systemSettingContext)
            <div class="admin-settings-wrapper">
                <h1>{{ __("admin.settings.context.".$context) }}</h1>
                <div class="admin-toggle-list">
                    @foreach($systemSettingContext AS $key=>$systemSetting)
                        <div class="admin-toggle-item-wrapper">  
                            <div class="admin-toggle-item admin-activity-wrapper">
                                <div class="admin-toggle-switch-wrapper">
                                    <label class="toggle-switch">
                                        <input type="checkbox" data-id="{{ $systemSetting['id'] }}" class="toggle-switch-checkbox" {{ $systemSetting['value'] == 1 ? 'checked' : '' }}>
                                        <span class="toggle-slider round"></span>
                                    </label>
                                </div>
                                <div class="admin-toggle-label">
                                    <span>    
                                        {{ __("admin.settings.meta.".$context.".".$systemSetting["key"]) }}
                                    </span>
                                    <div class="d-none alert-icon alert-icon-loading">
                                        <i class="fas fa-cog fa-spin"></i>
                                    </div>
                                    <div class="d-none alert-icon alert-icon-success">    
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                </div>
                            </div>
                            <!--
                                <div class="d-none alert alert-warning" role="alert">
                                    {{ __("admin.settings.saving") }}
                                </div> 
                                <div class="d-none alert alert-success" role="alert">
                                    {{ __("admin.settings.saved") }}
                                </div>
                                <div class="d-none alert alert-danger" role="alert">
                                    {{ __("admin.settings.error") }}
                                </div>
                            -->    
                        </div>    
                    @endforeach
                </div>
            </div>    
        @endforeach
    </div>    
@endsection