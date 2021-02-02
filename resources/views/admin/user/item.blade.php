@extends('admin.newlayout.layout',['breadcom'=>['Users','Edit',$user->name]])
@section('title')
    {{ trans('admin.edit_user') }}
@endsection
@section('page')
    <div class="cards">
        <div class="card-body">
            <div class="tabs">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a href="#main" class="nav-link active" data-toggle="tab"> {{ trans('admin.general') }} </a>
                    </li>
                    <li class="nav-item">
                        <a href="#profile" class="nav-link" data-toggle="tab">{{ trans('admin.profile') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="#images" class="nav-link" data-toggle="tab">{{ trans('admin.image') }}/{{ trans('admin.video') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="#seller" class="nav-link" data-toggle="tab">{{ trans('admin.vendor_info') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="#rate" class="nav-link" data-toggle="tab">{{ trans('admin.users_badges') }}</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="main" class="tab-pane active">
                        <form action="/admin/user/edit/{{$user->id}}" class="form-horizontal form-bordered" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault">{{ trans('admin.real_name') }}</label>
                                <div class="col-md-6">
                                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputReadOnly">{{ trans('admin.username') }}</label>
                                <div class="col-md-6">
                                    <input type="text" value="{{ $user->username }}" id="inputReadOnly" class="form-control" readonly="readonly">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputReadOnly">{{ trans('admin.email') }}</label>
                                <div class="col-md-6">
                                    <input type="text" value="{{ $user->email }}" id="inputReadOnly" class="form-control text-left" dir="ltr" readonly="readonly">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">{{ trans('admin.th_status') }}</label>
                                <div class="col-md-6">
                                    <select name="mode" class="form-control populate">
                                        <option value="active" {{ $user->mode=='active' ? 'selected="selected"' : '' }}>{{ trans('admin.active') }}</option>
                                        <option value="block" {{ $user->mode=='block' ? 'selected="selected"' : '' }}>{{ trans('admin.banned') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-3 birthday-group @if($user->mode == 'active') hidden @endif">
                                    <div class="input-group">
                                        <input type="date" name="blockDate" class="form-control" id="blockDate" value="@if(isset($meta['blockDate'])) {{date('d-m-Y',$meta['blockDate'])}} @endif">
                                        <span class="input-group-append bdatebtn" id="bdatebtn">
                                            <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">{{ trans('admin.user_groups') }}</label>
                                <div class="col-md-6">
                                    <select name="category_id" class="form-control populate">
                                        @foreach($category as $cat)
                                            <option value="{{ $cat->id }}" {{ $user->category_id == $cat->id ? 'selected="selected"' : '' }}>{{ $cat->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 switch switch-sm switch-primary">
                                    <input type="hidden" value="0" name="vendor">
                                    <input type="checkbox" name="vendor" value="1" data-plugin-ios-switch @if(isset($user->vendor) and $user->vendor == 1) {{ 'checked="checked"' }} @endif/>&nbsp;&nbsp;Vendor
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="submit">{{ trans('admin.save_changes') }}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div id="profile" class="tab-pane">
                        <form action="/admin/user/editprofile/{{$user->id}}" class="form-horizontal form-bordered" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault">{{ trans('admin.birthday') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="date" name="birthday" id="birthday" value="{{ $meta['birthday'] ?? '' }}" class="form-control text-center" >
                                        <span class="input-group-append fdatebtn" id="fdatebtn"><span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault">{{ trans('admin.gender') }}</label>
                                <div class="col-md-6">
                                    <select name="sex" class="form-control">
                                        <option value="male" @if(isset($meta['sex']) and $meta['sex'] == 'male') selected @endif>{{ trans('admin.male') }}</option>
                                        <option value="female" @if(isset($meta['sex']) and $meta['sex'] == 'female') selected @endif>{{ trans('admin.female') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault">{{ trans('admin.biography') }}</label>
                                <div class="col-md-6">
                                    <textarea name="biography" class="form-control" rows="10" >{{ $meta['biography'] ?? '' }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="submit">{{ trans('admin.save_changes') }}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div id="images" class="tab-pane">
                        <form action="/admin/user/editprofile/{{$user->id}}" class="form-horizontal form-bordered" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label class="col-md-3 control-label">{{ trans('admin.profile_pic') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group" style="display: flex">
                                        <button type="button" data-input="avatar" data-preview="holder" class="lfm_image btn btn-primary">
                                            Choose
                                        </button>
                                        <input id="avatar" class="form-control" type="text" name="avatar" dir="ltr" value="{{ $meta['avatar'] ?? '' }}" >
                                        <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="avatar">
                                            <span class="input-group-text">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">{{ trans('admin.profile_background') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group" style="display: flex">
                                        <button type="button" data-input="profile_image" data-preview="holder" class="lfm_image btn btn-primary">
                                            Choose
                                        </button>
                                        <input id="profile_image" class="form-control" type="text" name="profile_image" dir="ltr" value="{{ $meta['profile_image'] ?? '' }}" >
                                        <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="profile_image">
                                                <span class="input-group-text">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">{{ trans('admin.video_biography') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group" style="display: flex">
                                        <button type="button" data-input="videography" data-preview="holder" class="lfm_image btn btn-primary">
                                            Choose
                                        </button>
                                        <input id="videography" class="form-control" type="text" name="videography" dir="ltr" value="{{ $meta['videography'] ?? '' }}" >
                                        <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="videography">
                                                <span class="input-group-text">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="submit">{{ trans('admin.save_changes') }}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div id="rate" class="tab-pane ow-h">
                        <div class="col-xs-12 custom-item">
                            <b>{{ trans('admin.autimatic_badges') }}</b>
                            <hr>
                            <div class="col-xs-12 h-15"></div>
                            <div class="col-xs-12">
                                @if(!empty($getrate))
                                    @foreach($getrate as $rate)
                                        <div class="col-md-1 col-xs-1 text-center">
                                            <img title="{{ $rate['description'] ?? '' }}" src="{{ $rate['image'] ?? '' }}" class="img-responsive">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-xs-12 h-15"></div>
                        </div>
                        <div class="col-xs-12 h-15"></div>
                        <form action="/admin/user/ratesection/{{$user->id}}" class="form-horizontal form-bordered" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="inputDefault">{{ trans('admin.select_item') }}</label>
                                <div class="col-md-8">
                                    <select name="rate" class="form-control">
                                        @foreach($lists as $list)
                                            <option value="{{ $list['id'] ?? 0 }}">{{ $list['description'] ?? '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 text-left">
                                    <button class="btn btn-primary" type="submit">{{ trans('admin.add_to_user') }}</button>
                                </div>
                            </div>
                        </form>
                        <div class="col-xs-12 h-15"></div>
                        <div class="col-md-12 custom-item">
                            <b>{{ trans('admin.add_badge_to_user') }}</b>
                            <hr>
                            @if(!empty($mrates))
                                @foreach($mrates as $mrate)
                                    <div class="col-md-1 text-center col-xs-1">
                                        <a href="#" data-href="/admin/user/ratesection/delete/{{ $mrate->id }}" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times"></i></a>
                                        <br>
                                        <img src="{{ $mrate->rate->image ?? '' }}" title="{{ $mrate->rate->description ?? '' }}" class="img-responsive m-0-0">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div id="seller" class="tab-pane">
                        <form class="form-horizontal form-bordered" method="post" action="/admin/user/editprofile/{{$user->id}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault">{{ trans('admin.bank_name') }}</label>
                                <div class="col-md-6">
                                    <input type="text" name="bank_name" value="{{ $meta['bank_name'] ?? '' }}" class="form-control text-center" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault">{{ trans('admin.account_number') }}</label>
                                <div class="col-md-6">
                                    <input type="text" name="bank_account" value="{{ $meta['bank_account'] ?? '' }}" class="form-control text-center" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault">{{ trans('admin.creditcard_number') }}</label>
                                <div class="col-md-6">
                                    <input type="text" name="bank_card" value="{{ $meta['bank_card'] ?? '' }}" class="form-control text-center" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault">{{ trans('admin.passport_id') }}</label>
                                <div class="col-md-6">
                                    <input type="text" name="melli_code" value="{{ $meta['melli_code'] ?? '' }}" class="form-control text-center" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">{{ trans('admin.identity_scan') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group" style="display: flex">
                                        <button type="button" data-input="melli_card" data-preview="holder" class="lfm_image btn btn-primary">
                                            Choose
                                        </button>
                                        <input id="melli_card" class="form-control" type="text" name="melli_card" dir="ltr" value="{{ $meta['melli_card'] ?? '' }}" >
                                        <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="melli_card">
                                                <span class="input-group-text">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 switch switch-sm switch-primary">
                                    <input type="hidden" value="0" name="seller_apply">
                                    <input type="checkbox" name="seller_apply" value="1" data-plugin-ios-switch @if(isset($meta['seller_apply']) and $meta['seller_apply'] == 1) {{ 'checked="checked"' }} @endif/>&nbsp;&nbsp;{{ trans('admin.verified_vendor') }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="submit">{{ trans('admin.save_changes') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
