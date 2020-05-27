@extends('layouts.admin')

@section('content')
    <table class="admin-data-table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('admin.name') }}</th>
                <th scope="col">{{ __('admin.slug') }}</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
@endsection
