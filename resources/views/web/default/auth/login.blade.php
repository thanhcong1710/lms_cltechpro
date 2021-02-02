@extends(getTemplate().'.view.layout.layout')
@section('title')
    {{ !empty($setting['site']['site_title']) ? $setting['site']['site_title'] : 'Website Title' }}
    {{ trans('main.user_login') }}
@endsection
@section('page')
    <div class="login-s" style="background: url('{{ get_option('login_page_background') }}');min-height: 750px;">
        <div class="h-25"></div>
        <div class="h-25"></div>
        <div class="container text-center">
            <div class="formBox level-login" dir="ltr">
                <div class="box boxShaddow"></div>
                <div class="box loginBox">
                    <h2>{{ trans('main.login') }}</h2>
                    <form class="form" action="/login" method="post" id="loginForm" style="text-align: left;direction: ltr">
                        {{ csrf_field() }}
                        <div class="f_row">
                            <label>{{ trans('main.username_email') }}</label>
                            <input type="text" name="username" class="input-field validate" autocomplete="new-password" valid-title="Fill out this form" required>
                            <u></u>
                        </div>
                        <div class="f_row last">
                            <label>{{ trans('main.password') }}</label>
                            <input type="password" name="password" class="input-field validate" valid-title="Fill out this form" autocomplete="new-password" required>
                            <u></u>
                        </div>
                        <input type="hidden" name="remember" value="0">
                        <input class="input-rem" type="checkbox" name="remember" value="1" style="display:block;position: relative;top: 16px;width: auto;height: auto"><label style="margin-left: 15px;">{{ trans('main.remember') }}</label>
                        <button class="btn btn-custom pull-left btn-register-user-r"><span>{{ trans('main.sign_in') }}</span></button>
                        <div class="h-10"></div>
                        <div class="f_link">
                            <a href="" class="resetTag restag pull-right" style="color: #242424 !important;">{{ trans('main.forget_password') }}</a>
                            <a href="/user/sociliate/google" class="btn btn-custom btn-check-form pull-left"><i class="fa fa-google-plus icon-rs"></i><span>{{ trans('main.sign_in_google') }}</span></a>
                        </div>
                    </form>
                </div>
                <div class="box forgetbox">
                    <a href="#" class="back icon-back">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 199.404 199.404" style="enable-background:new 0 0 199.404 199.404;"
                             xml:space="preserve">
                            <polygon points="199.404,81.529 74.742,81.529 127.987,28.285 99.701,0 0,99.702 99.701,199.404 127.987,171.119 74.742,117.876
                                199.404,117.876 "/>
                        </svg>
                    </a>
                    <h2>{{ trans('main.reset_password') }}</h2>
                    <form class="form" action="/user/reset" method="post">
                        {{ csrf_field() }}
                        <p>{{ trans('main.enter_email_reset_password') }} </p>
                        <div class="f_row last">
                            <label>{{ trans('main.email') }}</label>
                            <input type="text" name="email" class="input-field validate" valid-title="Enter your email address" required>
                            <u></u>
                        </div>
                        <button class="btn btn-primary pull-left white-c"><span>{{ trans('main.reset') }}</span></button>
                    </form>
                </div>
                <div class="box registerBox" style="height: 650px">
                    <span class="reg_bg"></span>
                    <form class="form" method="post" action="/registerUser" style="text-align: left">
                        {{ csrf_field() }}
                        <div class="f_row">
                            <label>{{ trans('main.username') }}</label>
                            <input type="text" name="username" valid-title="Fill out this form." class="input-field validate" required>
                            <u></u>
                        </div>
                        <div class="f_row">
                            <label>{{ trans('main.password') }}</label>
                            <input type="password" id="r-password" valid-title="Fill out this form." name="password" class="input-field validate" required>
                            <u></u>
                        </div>
                        <div class="f_row">
                            <label>{{ trans('main.retype_password') }}</label>
                            <input type="password" id="r-re-password" name="password_confirmation" valid-title="Fill out this form." class="input-field validate" required>
                            <u></u>
                        </div>
                        <div class="f_row">
                            <label>{{ trans('main.realname') }}</label>
                            <input type="name" name="name" class="input-field validate" valid-title="Enter your real name" required>
                            <u></u>
                        </div>
                        <div class="f_row last" style="margin-bottom: 20px;">
                            <label>{{ trans('main.email') }}</label>
                            <input type="email" name="email" class="input-field validate" valid-title="Enter your email address" required>
                            <u></u>
                        </div>
                        <div class="form-group tab-con">
                            <input type="checkbox" class="input-r" name="terms" style="display: block;position: relative;top: 16px;width: auto;height: auto" valid-title="If you want to continue please accept terms and rules" required>
                            <label class="label-r" style="margin-left: 15px;">{{ trans('main.i_accept') }} <a href="/page/pages_terms">{{ trans('main.term_rules') }}</a></label>
                        </div>
                        <button class="btn btn-custom pull-left btn-register-user btn-register-user-r">{{ trans('main.register') }}</button>
                    </form>
                </div>
                <a href="#" class="regTag icon-add">
                    <strong class="fos-s">{{ trans('main.register') }}</strong>
                </a>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).keypress(function (e) {
            if (e.which == 13) {
                $('#loginForm').submit();
            }
        });
    </script>
    <script>
        $('.btn-register-user').on('click', function (e) {
            if ($('#r-password').val() != $('#r-re-password').val()) {
                $.notify({
                    message: 'Password & its confirmation are not the same.'
                }, {
                    type: 'danger',
                    allow_dismiss: false,
                    z_index: '99999999',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    position: 'fixed'
                });
                e.preventDefault();
            }
        })
    </script>
    <script>
        $('.regTag').click(function () {
            if ($('.regTag strong').text() == 'Register') {
                $('.regTag strong').text('Login');
                $('.regTag strong').css('position', 'static');
            } else {
                $('.regTag strong').text('Register');
                $('.regTag strong').css('position', 'relative');
                $('.regTag strong').css('top', '-8px');
            }
        })
    </script>
@endsection
