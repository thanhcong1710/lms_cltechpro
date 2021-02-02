@extends($user['vendor'] == 1 ? getTemplate() . '.user.layout.balancelayout' : getTemplate() . '.user.layout_user.balancelayout')

@section('tab6','active')
@section('tab')
    <div class="h-20"></div>
    @if(count($lists) == 0)
        <div class="text-center">
            <img src="/assets/default/images/empty/financialdocs.png">
            <div class="h-20"></div>
            <span class="empty-first-line">{{ trans('main.no_financial_doc') }}</span>
            <div class="h-20"></div>
        </div>
    @else
        <div class="table-responsive">
            <table class="table ucp-table" id="log-table">
                <thead class="back-orange">
                <th width="20" class="text-center">#</th>
                <th class="cell-ta">{{ trans('main.title') }}</th>
                <th class="cell-ta">{{ trans('main.description') }}</th>
                <th class="text-center" width="100">{{ trans('main.amount') }} ({{ currencySign() }})</th>
                <th class="text-center" width="100">{{ trans('main.type') }}</th>
                <th class="text-center" width="100">{{ trans('main.creator') }}</th>
                <th class="text-center" width="200">{{ trans('main.date') }}</th>

                </thead>
                <tbody>
                @foreach($lists as $item)
                    <tr>
                        <td class="text-center">{{ $item->id }}</td>
                        <td class="cell-ta">{{ $item->title }}</td>
                        <td class="cell-ta">{{ $item->description }}</td>
                        <td class="text-center"><b @if($item->type =='add') class="green-s" @else class="red-s" @endif>{{ $item->price }}</b></td>
                        <td class="text-center">
                            @if($item->type =='add')
                                <b class="green-s">{{ trans('main.addiction') }}</b>
                            @else
                                <b class="red-s">{{ trans('main.deduction') }}</b>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($item->mode == 'auto')
                                <span>{{ trans('main.automatic') }}</span>
                            @else
                                <span>{{ $item->exporter->name ?? $item->exporter->username }}</span>
                            @endif
                        </td>
                        <td class="text-center" width="150">{{ date('d F Y | H:i',$item->created_at) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            @if(empty(request()->get('p')) and $count > 20)
                <a href="?p=1" class="next-pagination pull-left"><span class="pagicon mdi mdi-chevron-left"></span></a>
            @endif
            @if(!empty(request()->get('p')) and $count>(request()->get('p') +1) * 20)
                <a href="?p={{ request()->get('p') + 1 }}" class="next-pagination pull-left"><span class="pagicon mdi mdi-chevron-left"></span></a>
            @endif
            @if(!empty(request()->get('p')) and request()->get('p') > 0)
                <a href="?p={{ request()->get('p') -1 }}" class="next-pagination pull-right"><span class="pagicon mdi mdi-chevron-right"></span></a>
            @endif
        </div>
    @endif
@endsection
