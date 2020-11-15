@extends('layouts.admin')

@section('content')
    <div class="admin-content-table-wrapper">
        <div class="admin-settings-wrapper">
            <h1>{{ __("admin.defalts.context.units") }}</h1>
        </div>
        <div class="admin-settings-wrapper">    
            <div>
                <span>{{ __("admin.defalts.context.units.measure") }}</span>    
            </div>
            <div>
                <select class="form-control" id="unit_measure">
                    <option value="meter">Meter</option>
                    <option value="mile">Mile</option>
                </select>
            </div>
        </div>
        <div class="admin-settings-wrapper">
            <div>
                <span>{{ __("admin.defalts.context.units.currency") }}</span>    
            </div>
            <div>
                <select class="form-control" id="currency_measure">
                    
                </select>
            </div>
        </div>
        <div class="admin-settings-wrapper">
            <h1>{{ __("admin.defalts.context.meta") }}</h1>
            
                <div>
                    <span>{{ __("admin.defalts.context.meta.") }}</span>    
                </div>
                <div>
                    <div class="form-inline">
                        <div class="form-group mr-2">
                            <input type="password" class="form-control" id="" placeholder="{{ __('') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __("Save") }}</button>
                    </div>
                </div>

        </div>      
    </div>    
@endsection