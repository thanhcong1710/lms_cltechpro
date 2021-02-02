@extends('admin.newlayout.layout',['breadcom'=>['Users','Identity Verification','Admin Panel']])
@section('title')
    {{ trans('admin.identity_verification') }}
@endsection
@section('page')

    <section class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-none" style="margin-bottom: 0;" id="datatable-details">
                    <thead>
                    <tr>
                        <th class="text-center">{{ trans('admin.username') }}</th>
                        <th class="text-center">{{ trans('admin.real_name') }}</th>
                        <th class="text-center">{{ trans('admin.reg_date') }}</th>
                        <th class="text-center" width="100">{{ trans('admin.income') }}</th>
                        <th class="text-center" width="100">{{ trans('admin.account_balance') }}</th>
                        <th class="text-center">{{ trans('admin.courses') }}</th>
                        <th class="text-center">{{ trans('admin.purchases') }}</th>
                        <th class="text-center">{{ trans('admin.sales') }}</th>
                        <th class="text-center">{{ trans('admin.user_groups') }}</th>
                        <th class="text-center">{{ trans('admin.th_controls') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th class="text-center"><a target="_blank" href="/profile/{{ $user->id }}">{{ $user->username }}</a></th>
                            <th class="text-center">{{ $user->name }}</th>
                            <th class="text-center">{{ date('d F Y : H:i',$user->created_at) }}</th>
                            <th class="text-center number-green" width="100" @if($user->income < 0) style="color:red !important;" @endif dir="ltr">{{ $user->income ?? 0 }}</th>
                            <th class="text-center number-green" width="100" @if($user->credit < 0) style="color:red !important;" @endif dir="ltr">{{ $user->credit ?? 0 }}</th>
                            <th class="text-center"><a href="/admin/content/user/{{ $user->id }}">{{ $user->contents_count ?? 0 }}</a></th>
                            <th class="text-center"><a href="/admin/buysell/list/?buyer={{ $user->id }}">{{ $user->buys_count ?? 0 }}</a></th>
                            <th class="text-center"><a href="/admin/buysell/list/?user={{ $user->id }}">{{ $user->sells_count ?? 0 }}</a></th>
                            <th class="text-center">
                                @if(!empty($user->category->id))
                                    <a href="/admin/user/incategory/{{$user->category->id}}">{{$user->category->title}}</a>
                                @endif
                            </th>
                            <th class="text-center">
                                <a href="/admin/user/item/{{ $user->id }}" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                <a href="/admin/user/userlogin/{{ $user->id }}" title="Login as user" target="_blank"><i class="fa fa-user" aria-hidden="true"></i></a>
                                <a href="#" data-href="/admin/user/delete/{{ $user->id }}" title="Delete" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection


