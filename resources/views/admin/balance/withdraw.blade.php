@extends('admin.newlayout.layout',['breadcom'=>['Accounting','Withdrawal List']])
@section('title')
    {{ trans('admin.withdrawal_list') }}
@endsection
@section('page')

    <section class="card">
        <div class="card-body">
            <div class="col-md-12 col-xs-12">
                <form>
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="date" class="form-control" id="fdate" name="fdate" value="{!! !empty(request()->get('fdate')) ? request()->get('fdate') : '' !!}">
                                <span class="input-group-append fdatebtn" id="fdatebtn">
                                    <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="date" class="form-control" id="ldate" name="ldate" value="{!! !empty(request()->get('ldate')) ? request()->get('ldate') : '' !!}">
                                <span class="input-group-append ldatebtn" id="ldatebtn">
                                    <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" placeholder="Minimum User Balance" name="withdraw" value="{!! !empty(request()->get('withdraw')) ? request()->get('withdraw') : '' !!}" class="form-control text-center">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="submit" class="text-center btn btn-primary w-100" value="Show Withdrawal List">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row h-20"></div>
            @if(count($users)>0)
                <div class="col-md-12 col-xs-12 alert alert-success">
                    <span>{!! trans('admin.from') !!}</span>
                    <span class="f-w-b">{{ date('d F Y',$first->created_at) }}</span>
                    <span>{!! trans('admin.to') !!}</span>
                    <span class="f-w-b">{{ date('d F Y',$last->created_at) }}</span>
                    <span>{!! trans('admin.total_withdrawal') !!}</span>
                    <span class="f-w-b">{{ $allsum }}</span>
                    <span>{!! trans('admin.cur_dollar') !!}</span>
                </div>
            @endif
        </div>
    </section>
    <a href="/admin/balance/withdraw/excel?{!! http_build_query(Request()->all()) !!}" class="btn btn-primary">Export as Excel file</a>
    <div class="h-10"></div>
    <section class="card">
        <div class="card-header">
            <h5>{!! trans('admin.vendors') !!}</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th class="text-center">{{ trans('admin.username') }}</th>
                    <th class="text-center">{{ trans('admin.real_name') }}</th>
                    <th class="text-center" width="100">{{ trans('admin.income') }}</th>
                    <th class="text-center">{{ trans('admin.bank_name') }}</th>
                    <th class="text-center">{{ trans('admin.creditcard_number') }}</th>
                    <th class="text-center">{{ trans('admin.account_number') }}</th>
                    <th class="text-center">{{ trans('admin.th_controls') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <?php $meta = arrayToList($user->userMetas, 'option', 'value'); ?>
                    <tr>
                        <th class="text-center">{{ $user->username }}</th>
                        <th class="text-center">{{ $user->name }}</th>
                        <th class="text-center number-green" width="100" @if($user->income<0) style="color:red !important;" @endif>{{ $user->income }}</th>
                        <th class="text-center">{{ !empty($meta['bank_name']) ? $meta['bank_name'] : '' }}</th>
                        <th class="text-center">{{ !empty($meta['bank_card']) ? $meta['bank_card'] : '' }}</th>
                        <th class="text-center">{{ !empty($meta['bank_account']) ? $meta['bank_account'] : '' }}</th>
                        <th class="text-center">
                            <a href="/admin/balance/new/?user={{ $user->id }}" title="Create financial doc."><i class="fa fa-line-chart" aria-hidden="true"></i></a>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <section class="card">
        <div class="card-header">
            <h5>{!! trans('admin.not_identity_verified_vendors') !!}</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th class="text-center">{{ trans('admin.username') }}</th>
                    <th class="text-center">{{ trans('admin.real_name') }}</th>
                    <th class="text-center" width="100">{{ trans('admin.income') }}</th>
                    <th class="text-center">{{ trans('admin.bank_name') }}</th>
                    <th class="text-center">{{ trans('admin.creditcard_number') }}</th>
                    <th class="text-center">{{ trans('admin.account_number') }}</th>
                    <th class="text-center">{{ trans('admin.th_controls') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users_not_apply as $user)
                    <?php $meta = arrayToList($user->userMetas, 'option', 'value'); ?>
                    <tr>
                        <th class="text-center">{{ $user->username }}</th>
                        <th class="text-center">{{ $user->name }}</th>
                        <th class="text-center number-green" width="100" @if($user->income<0) style="color:red !important;" @endif>{{ $user->income }}</th>
                        <th class="text-center">{{ !empty($meta['bank_name']) ? $meta['bank_name'] : '' }}</th>
                        <th class="text-center">{{ !empty($meta['bank_card']) ? $meta['bank_card'] : '' }}</th>
                        <th class="text-center">{{ !empty($meta['bank_account']) ? $meta['bank_account'] : '' }}</th>
                        <th class="text-center">
                            <a href="/admin/notification/new?recipent_type=userone&uid={{ $user->id }}" title="Send notification"><i class="fa fa-bell-o" aria-hidden="true"></i></a>
                            <a href="/admin/balance/new/?user={{ $user->id }}" title="Create financial doc."><i class="fa fa-line-chart" aria-hidden="true"></i></a>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <section class="card">
        <div class="card-header">
            <h5>{!! trans('admin.vendor_postal_sale') !!}</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th class="text-center">{{ trans('admin.username') }}</th>
                    <th class="text-center">{{ trans('admin.real_name') }}</th>
                    <th class="text-center" width="100">{{ trans('admin.income') }}</th>
                    <th class="text-center">{{ trans('admin.bank_name') }}</th>
                    <th class="text-center">{{ trans('admin.creditcard_number') }}</th>
                    <th class="text-center">{{ trans('admin.account_number') }}</th>
                    <th class="text-center">{{ trans('admin.th_controls') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users_sell_post as $user)
                    <?php $meta = arrayToList($user->userMetas, 'option', 'value'); ?>
                    <tr>
                        <th class="text-center">{{ $user->username }}</th>
                        <th class="text-center">{{ $user->name }}</th>
                        <th class="text-center number-green" width="100" @if($user->income<0) style="color:red !important;" @endif>{{ $user->income }}</th>
                        <th class="text-center">{{ !empty($meta['bank_name']) ? $meta['bank_name'] : '' }}</th>
                        <th class="text-center">{{ !empty($meta['bank_card']) ? $meta['bank_card'] : '' }}</th>
                        <th class="text-center">{{ !empty($meta['bank_account']) ? $meta['bank_account'] : '' }}</th>
                        <th class="text-center">
                            <a href="/admin/notification/new?recipent_type=userone&uid={{ $user->id }}" title="Send notification"><i class="fa fa-bell-o" aria-hidden="true"></i></a>
                            <a href="/admin/balance/new/?user={{ $user->id }}" title="Create financial doc."><i class="fa fa-line-chart" aria-hidden="true"></i></a>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

@endsection
