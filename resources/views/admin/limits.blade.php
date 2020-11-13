@extends('layouts.admin')

@section('content')
    <div class="admin-content-table-wrapper">
        @foreach($systemLimits AS $context=>$systemLimitContext)
            <div class="admin-settings-wrapper">
                <h1>{{ __("admin.limits.context.".$context) }}</h1>
                <div class="admin-toggle-list">
                    @foreach($systemLimitContext AS $key=>$systemLimit)
                        <div class="admin-toggle-item-wrapper">  
                            <div class="admin-limit-item" style="height: 54px;">
                                <div style="line-height: 38px; width: calc(100% - 80px); float: left; margin-left: 0px;">
                                    {{ __("admin.limits.meta.".$context.".".$systemLimit["key"]) }}
                                </div>
                                <div style="width: 80px; float: left; margin-left: 0px;">
                                    <select class="system-limit form-control" id="{{ $context.'_'.$systemLimit["key"] }}" data-id="{{ $systemLimit['id'] }}" data-pre="{{ $systemLimit['value'] }}" data-id="{{ $systemLimit['id'] }}">
                                        @for($i = $defaultSystemLimits[$context][$systemLimit["key"]]["range_min"]; $i <= $defaultSystemLimits[$context][$systemLimit["key"]]["range_max"]; $i++)
                                            <option {{ $systemLimit['value'] == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="d-none alert alert-warning" role="alert">
                                {{ __("admin.limits.saving") }}
                            </div> 
                            <div class="d-none alert alert-success" role="alert">
                                {{ __("admin.limits.saved") }}
                            </div>
                            <div class="d-none alert alert-danger" role="alert">
                                {{ __("admin.limits.error") }}
                            </div>
                        </div>    
                    @endforeach
                </div>
            </div>    
        @endforeach
    </div>    
@endsection