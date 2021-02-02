@if(!empty(session('Error')))

    @if(session('Error') == 'duplicate_user')
        <span>{{ trans('main.entered_username_exists') }}</span>
    @endif

    @if(session('Error') == 'duplicate_email')
        <span>{{ trans('main.entered_email_exists') }}</span>
    @endif

    @if(session('Error') == 'password_not_same')
        <span>{{ trans('main.pass_confirmation_same') }}</span>
    @endif

@endif

<form method="post" action="/registerUser">
    {{ csrf_field() }}
    <input type="text" name="username" placeholder="Username" required>
    <br>
    <input type="email" name="email" placeholder="Email" required>
    <br>
    <input type="password" name="password" placeholder="Password" required>
    <br>
    <input type="password" name="repassword" placeholder="Confirm Password" required>
    <br>
    <input type="submit" name="submit" value="Register">
    <br>
    <a href="/user/google/login">{{ trans('main.sign_in_google') }}</a>
</form>
