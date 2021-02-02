@include(getTemplate().'.view.layout.header',['title'=>'User Panel'])
@if($user['vendor'] == 1)
    @include(getTemplate().'.user.layout.menu')
@else
    @include(getTemplate().'.user.layout_user.menu')
@endif
@yield('pages')
@include(getTemplate().'.user.layout.modals')
@include(getTemplate().'.view.layout.footer')
