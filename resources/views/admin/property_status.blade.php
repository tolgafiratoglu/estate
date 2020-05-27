@extends('layouts.admin')

@section('content')
    <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('admin.name') }}</th>
            <th scope="col">{{ __('admin.slug') }}</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($adminPropertyStatusList AS $propertyStatus)
            <tr>
                <th scope="row">{{ $propertyStatus["id"] }}</th>
                <td>{{ $propertyStatus["name"] }}</td>
                <td>{{ $propertyStatus["slug"] }}</td>
                <td class="text-right">
                        <i class="far fa-edit"></i>
                        <i class="far fa-trash-alt"></i>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
