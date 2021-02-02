@include(getTemplate().'.view.layout.header',['title'=>'User Panel'])
@include(getTemplate().'.user.layout.menu')
@section('title','Courses')
<div class="h-20"></div>
<div class="container-fluid">
    <div class="container">
        <div class="col-md-12 col-xs-12">
            <ul class="nav nav-tabs nav-justified panel-tabs" role="tablist">
                <li class="@yield('tab1')">
                    <a href="/user/content">
                        <span class="submicon mdi mdi-library-movie"></span>
                        {{ trans('main.my_courses') }}
                    </a>
                </li>
                <li class="@yield('tab2')">
                    <a href="/user/video/buy">
                        <span class="submicon mdi mdi-cloud-download"></span>
                        {{ trans('main.my_purchases') }}
                    </a>
                </li>
                <li class="@yield('tab7')">
                    <a href="/user/video/live">
                        <span class="submicon mdi mdi-video"></span>
                        {{ trans('main.live_class') }}</a>
                </li>
                @if(function_exists('checkQuiz'))
                <li class="@yield('tab3')">
                    <a href="/user/quizzes">
                        <span class="submicon mdi mdi-text"></span>
                        {{ trans('main.quizzes') }}
                    </a>
                </li>
                @endif
                <li class="@yield('tab4')">
                    <a href="/user/video/off">
                        <span class="submicon mdi mdi-sale"></span>
                        {{ trans('main.discounts') }}
                    </a>
                </li>
                <li class="@yield('tab5')">
                    <a href="/user/video/promotion">
                        <span class="submicon mdi mdi-rocket"></span>
                        {{ trans('main.promotions') }}
                    </a>
                </li>
                <li class="@yield('tab6')">
                    <a href="/user/video/request">
                        <span class="submicon mdi mdi-camera-enhance"></span>
                        {{ trans('main.requests') }}</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane fade in" id="tab1">
                    @yield('tab')
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script>$('#buy-hover').addClass('item-box-active');</script>
@endsection

@include(getTemplate().'.user.layout.modals')
@include(getTemplate().'.view.layout.footer')
