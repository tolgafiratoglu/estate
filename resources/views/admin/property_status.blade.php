@extends('layouts.admin')

@section('content')
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('admin.name') }}</th>
                <th scope="col">{{ __('admin.slug') }}</th>
                <th scope="col admin-control-th"></th>
                <th scope="col admin-control-th"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $dataItem)
            <tr>
                <th scope="row">{{ $dataItem["id"] }}</th>
                <td>{{ $dataItem["name"] }}</td>
                <td>{{ $dataItem["slug"] }}</td>
                <td class="admin-control-td">
                    <i class="far fa-edit"></i><span class="admin-control-label">{{ __('admin.edit') }}</span>
                </td>
                <td class="admin-control-td">
                    <i class="far fa-trash-alt"></i><span class="admin-control-label">{{ __('admin.delete') }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
