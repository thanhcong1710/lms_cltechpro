@extends($user['vendor'] == 1 ? getTemplate() . '.user.layout.balancelayout' : getTemplate() . '.user.layout_user.balancelayout')

@section('tab1','active')
@section('tab')
    <div class="h-20"></div>
    @if(count($lists) == 0)
        <div class="text-center">
            <img src="/assets/default/images/empty/sales.png">
            <div class="h-20"></div>
            <span class="empty-first-line">{{ trans('main.no_sale') }}</span>
            <div class="h-20"></div>
        </div>
    @else
        <div class="table-responsive">
            <table class="table ucp-table" id="download-table">
                <thead class="back-orange">
                <th width="20" class="text-center">#</th>
                <th>{{ trans('main.course_title') }}</th>
                <th class="text-center" width="100">{{ trans('main.customer') }}</th>
                <th class="text-center" width="50">{{ trans('main.price') }}</th>
                <th class="text-center" width="50">{{ trans('main.paid_amount') }}</th>
                <th class="text-center" width="100">{{ trans('main.income') }}</th>
                <th class="text-center" width="50">{{ trans('main.discount') }}</th>
                <th class="text-center" width="100">{{ trans('main.delivery_type') }}</th>
                <th class="text-center" width="200">{{ trans('main.date') }}</th>
                <th class="text-center" width="100">{{ trans('main.status') }}</th>
                <th class="text-center" width="40">{{ trans('main.more_info') }}</th>
                </thead>
                <tbody>
                @foreach($lists as $item)
                    @if(isset($item->content->metas))
                        <?php $contentMeta = arrayToList($item->content->metas, 'option', 'value'); ?>
                        <tr>
                            <td class="text-center" width="20">{{ $item->id }}</td>
                            <td class="text-left">
                                @if (!empty($item->content))
                                    <a href="/product/{{ $item->content->id }}" class="color-in" target="_blank">{{ $item->content->title }}</a>
                                @endif
                            </td>
                            <td class="text-center">
                                @if (!empty($item->buyer))
                                    <a href="/profile/{{ $item->buyer->id }}" class="color-in" target="_blank">{{ $item->buyer->username }}</a>
                                @endif
                            </td>
                            <td class="text-center">
                                @if (!empty($item->transaction))
                                    {{ $item->transaction->price_content }}
                                @endif
                            </td>
                            <td class="text-center">
                                @if (!empty($item->transaction))
                                    {{ $item->transaction->price }}
                                @endif
                            </td>
                            <td class="text-center">
                                @if (!empty($item->transaction))
                                    {{ $item->transaction->income }}
                                @endif
                            </td>
                            @if(!empty($item->transaction) and isset($item->transaction->price) and $item->transaction->price > 0 and $item->transaction->price_content>0 and  (100 - ($item->transaction->price/$item->transaction->price_content) * 100) > 0)
                                <td class="text-center">%{{ 100 - (($item->transaction->price / $item->transaction->price_content) * 100) }}</td>
                            @else
                                <td class="text-center">%0</td>
                            @endif
                            <td class="text-center">
                                @if($item->type == "download")
                                    <span class="green-s">{{ trans('main.download') }}</span>
                                @elseif($item->type == 'subscribe')
                                    <span class="blue-s">{{ trans('main.subscribe') }}</span>
                                @else
                                    <span class="blue-s">{{ trans('main.postal') }}</span>
                                @endif
                            </td>
                            <td class="text-center" width="150">{{ date('d F Y | H:i',$item->created_at) }}</td>
                            <td class="text-center" width="100">
                                @if($item->type=="download")
                                    <b class="green-s">{{ trans('main.successful') }}</b>
                                @else
                                    @if($item->post_feedback == null)
                                        <b>{{ trans('main.waiting_delivery') }}</b>
                                    @elseif($item->post_feedback == 1)
                                        <b class="green-s">{{ trans('main.successful') }}</b>
                                    @elseif($item->post_feedback == 2 || $item->post_feedback == 3)
                                        <b class="red-s">{{ trans('main.failed') }}</b>
                                    @endif
                                @endif
                            </td>
                            <td class="text-center">
                                @if($item->type == 'post')
                                    <a class="gray-s" href="#" data-toggle="modal" data-target="#post{{ $item->id }}" title="More info"><span class="crticon mdi mdi-package"></span></a>
                                @else
                                    #
                                @endif
                            </td>
                        </tr>
                        <div class="modal fade" id="post{{ $item->id }}">
                            <div class="modal-dialog">
                                <form class="form form-horizontal" method="post" action="/user/video/buy/confirm/{{ $item->id }}">
                                    {{ csrf_field() }}
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">{{ trans('main.shipping_detail') }}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p> {{ trans('main.tracking_code') }}: <strong>@if($item->post_code == null or $item->post_code == '') {!! '<b class="red-s">Parcel not sent yet.</b>' !!} @else {{ $item->post_code }} @endif</strong></p>
                                            <br>
                                            <p>  {{ trans('main.shipping_date') }} <strong>@if(is_numeric($item->post_code_date)) {{ date('d F Y | H:i',$item->post_code_date) }} @endif</strong></p>
                                            <br>
                                            <p> {{ trans('main.address') }}: <strong>{{ userAddress($item->buyer_id) }}</strong></p>
                                        </div>
                                        <div class="modal-footer">
                                            <span class="pull-right star-rate-text">{{ trans('main.feedback') }}</span>&nbsp;
                                            <span class="pull-right star-rate" data-score="{{ !empty($item->rate) ? $item->rate->rate : 0 }}" disabled=""></span>
                                            <button type="button" class="btn btn-custom" data-dismiss="modal">{{ trans('main.close') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            @if(empty(request()->get('p')) and $count > 20)
                <a href="?p=1" class="next-pagination pull-left"><span class="pagicon mdi mdi-chevron-left"></span></a>
            @endif
            @if(!empty(request()->get('p')) and $count>(request()->get('p') + 1) * 20)
                <a href="?p={{ request()->get('p') + 1 }}" class="next-pagination pull-left"><span class="pagicon mdi mdi-chevron-left"></span></a>
            @endif
            @if(!empty(request()->get('p')) and request()->get('p') > 0)
                <a href="?p={{ request()->get('p')-1 }}" class="next-pagination pull-right"><span class="pagicon mdi mdi-chevron-right"></span></a>
            @endif
        </div>
    @endif
@endsection
@section('script')
    <script>$('#balance-hover').addClass('item-box-active');</script>
    <script>
        $('.star-rate').raty({
            readOnly: true,
            starType: 'i',
            score: function () {
                return $(this).attr('data-score');
            }
        });
    </script>
@endsection
