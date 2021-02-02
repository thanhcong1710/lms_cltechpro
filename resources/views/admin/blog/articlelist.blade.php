@extends('admin.newlayout.layout',['breadcom'=>['Blog','Articles']])
@section('title')
    {{ trans('admin.articles') }}
@endsection
@section('page')

    <section class="card">
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th>{{ trans('admin.th_title') }}</th>
                    <th class="text-center" width="150">{{ trans('admin.th_date') }}</th>
                    <th class="text-center">{{ trans('admin.username') }}</th>
                    <th class="text-center">{{ trans('admin.category') }}</th>
                    <th class="text-center">{{ trans('admin.th_status') }}</th>
                    <th class="text-center">{{ trans('admin.th_controls') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td class="text-center" width="150">{{ date('d F Y / H:i',$item->created_at) }}</td>
                        <td class="text-center" title="{{ !empty($item->user) ? $item->user->username : '' }}">{{ !empty($item->user) ? $item->user->name : '' }}</td>
                        <td class="text-center">{{ !empty($item->category) ? $item->category->title : '' }}</td>
                        <td class="text-center">
                            @if($item->mode == 'publish')
                                <b class="c-g">{{ trans('admin.published') }}</b>
                            @elseif($item->mode == 'draft')
                                <b class="c-g">{{ trans('admin.draft') }}</b>
                            @elseif($item->mode == 'request')
                                <b class="c-b">{{ trans('admin.review_request') }}</b>
                            @elseif($item->mode == 'delete')
                                <b class="c-r">{{ trans('admin.unpublish_request') }}</b>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="/admin/blog/article/edit/{{ $item->id }}" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            <a href="#" data-href="/admin/blog/article/delete/{{ $item->id }}" title="Delete" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

@endsection


