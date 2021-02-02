@extends(getTemplate().'.view.layout.layout')
@section('title')
    {{ !empty($setting['site']['site_title']) ? $setting['site']['site_title'] : '' }}
@endsection
@section('page')

    @include(getTemplate() . '.view.parts.slider')
    @include(getTemplate() . '.view.parts.container')
    @if(isset($setting['site']['main_page_newest_container']) and $setting['site']['main_page_newest_container'] == 1)
        @include(getTemplate() . '.view.parts.newest')
    @endif
    @if(isset($setting['site']['main_page_popular_container']) and $setting['site']['main_page_popular_container'] == 1)
        @include(getTemplate() . '.view.parts.popular')
        @include(getTemplate() . '.view.parts.most_sell')
    @endif
    @if(isset($setting['site']['main_page_vip_container']) and $setting['site']['main_page_vip_container'] == 1)
        @include(getTemplate() . '.view.parts.vip')
    @endif
    @include(getTemplate() . '.view.parts.news')

@endsection
