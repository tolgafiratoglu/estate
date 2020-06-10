@extends('layouts.admin')

@section('content')
    <div class="admin-content-table-wrapper">
        <div class="alert alert-success d-none" role="alert"></div>
        <div class="alert alert-danger d-none" role="alert">{{ __("admin.system_error") }}</div>
        <table class="admin-data-table display" data-deleted="{{ $deleted }}">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('admin.name') }}</th>
                    <th>{{ __('admin.slug') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>    
@endsection