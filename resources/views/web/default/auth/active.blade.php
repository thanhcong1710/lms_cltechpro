@extends(getTemplate().'.view.layout.layout')
@section('title')
    {{ !empty($setting['site']['site_title']) ? $setting['site']['site_title'] : 'Website title' }}
    {{ trans('main.active_account') }} -
@endsection
@section('page')
    <div class="h-25"></div>
    <div class="h-25"></div>
    <div class="col-md-4 col-md-offset-4 col-xs-12">
        <div class="ucp-section-box">
            <div class="header back-orange">{{ trans('main.activation') }}</div>
            <div class="body">
                <p>{{ trans('main.account_activation_success') }}</p>
            </div>
        </div>
    </div>

    <div class="h-10 clearfix"></div>
@endsection
