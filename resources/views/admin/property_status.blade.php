@extends('layouts.admin')

@section('content')
    <table data-deleted="{{ $deleted }}" class="admin-data-table display nowrap dataTable dtr-inline collapsed">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('admin.name') }}</th>
                <th scope="col">{{ __('admin.slug') }}</th>
                <th class="no-sort"></th>
                <th class="no-sort"></th>
            </tr>
        </thead>
        <tbody>
            <!-- Data coming from AJAX filles the table. -->
        </tbody>
    </table>
@endsection
