@extends($user['vendor'] == 1 ? getTemplate() . '.user.layout.videolayout' : getTemplate() . '.user.layout_user.videolayout')
@section('tab1','active')
@section('tab')
    <div class="h-20"></div>
    @if(count($lists) == 0)
        <div class="text-center">
            <img src="/assets/default/images/empty/Videos.png">
            <div class="h-20"></div>
            <span class="empty-first-line">{{ trans('main.no_course') }}</span>
            <div class="h-10"></div>
            <span class="empty-second-line">
                <span>{{ trans('main.go_to') }}</span>
                <a href="/user/content/new">{{ trans('main.upload_page') }}</a>
                <span>{{ trans('main.upload_your_first_course') }}</span>
            </span>
            <div class="h-20"></div>
        </div>
    @else
        <div class="table-responsive">
            <table class="table ucp-table" id="content-table">
                <thead class="thead-s">
                <th class="text-center" width="80">{{ trans('main.item_no') }}</th>
                <th>{{ trans('main.title') }}</th>
                <th class="text-center" width="200">{{ trans('main.publish_date') }}</th>
                <th class="text-center" width="50">{{ trans('main.sales') }}</th>
                <th class="text-center" width="50">{{ trans('main.parts') }}</th>
                <th class="text-center" width="200">{{ trans('main.category') }}</th>
                <th class="text-center" width="100">{{ trans('main.status') }}</th>
                <th class="text-center" width="150">{{ trans('main.controls') }}</th>
                </thead>
                <tbody>
                @foreach($lists as $item)
                    <tr>
                        <td class="text-center" width="50">VT-{{ $item->id }}</td>
                        @if($item->mode == 'publish')
                            <td><a href="/product/{{ $item->id }}" target="_blank">{{ $item->title }}</a></td>
                        @else
                            <td>{{ $item->title }}</td>
                        @endif
                        <td class="text-center" width="150">{{ date('d F Y | H:i',$item->created_at) }}</td>
                        <td class="text-center">{{ $item->sells_count }}</td>
                        <td class="text-center">{{ $item->partsactive_count }}</td>
                        <td class="text-center">
                            @if (!empty($item->category))
                                <a href="/category/{{ $item->category->class }}">{{ $item->category->title }}</a>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($item->mode == 'publish')
                                <b class="green-s">{{ trans('main.published') }}</b>
                            @elseif($item->mode == 'draft')
                                <b class="orange-s">{{ trans('main.draft') }}</b>
                            @elseif($item->mode == 'request')
                                <span class="red-s">{{ trans('main.waiting') }}</span>
                            @elseif($item->mode == 'delete')
                                <span class="red-s">{{ trans('main.unpublish_request') }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="/user/content/meeting/{{ $item->id }}" title="Meeting" class="gray-s"><span class="crticon mdi mdi-video"></span></a>
                            <a href="/user/content/edit/{{ $item->id }}" title="Edit" class="gray-s"><span class="crticon mdi mdi-lead-pencil"></span></a>
                            <a href="/user/content/delete/{{ $item->id }}" title="Delete" class="gray-s"><span class="crticon mdi mdi-delete-forever"></span></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
