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
                    @if(!$deleted)
                        <a href="/admin/property-status/edit/{{ $dataItem['id'] }}"><i class="far fa-edit"></i><span class="admin-control-label">{{ __('admin.edit') }}</span></a>
                    @else
                        <span data-toggle="modal" data-target="#delete_confirm"><i class="far fa-trash-alt"></i><span class="admin-control-label">{{ __('admin.delete') }}</span></span>
                    @endif
                </td>
                <td class="admin-control-td">
                    <span data-toggle="modal" data-target="#delete_confirm"><i class="far fa-trash-alt"></i><span class="admin-control-label">{{ __('admin.delete') }}</span></span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
