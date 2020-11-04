@extends('layouts.admin')

@section('content')
    <div class="admin-content-table-wrapper">
        @foreach($systemSettings AS $context=>$systemSettingContext)
            <div class="admin-settings-wrapper">
                <h1>{{ __($context) }}</h1>
                @foreach($systemSettingContext AS $key=>$systemSetting)
                    {{ $systemSetting["key"] }} {{ $systemSetting["value"] }}
                @endforeach
            </div>    
        @endforeach
    </div>    
@endsection