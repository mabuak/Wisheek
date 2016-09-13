@extends('layouts.master')
@section('content')

@include('includes.header')

<div class=" wrapper">

<div class="container fh ct">
<div class="am">

        @include ('utils/errors')

        {!! Form::open([
            'route'        => 'register.postRegister',
            'autocomplete' => 'off',
            "class" => "ui large form stacked segment small_form",
        ]) !!}

          <input name="code" type="text" placeholder="Username" hidden value="{!!Input::get('code')!!}">


            <div class="field">
            <div class="ui left icon big input">
              <input name="username" type="text" placeholder="Username" value="{!!Input::old('username')!!}" readonly onfocus="this.removeAttribute('readonly');">
              <i class="user icon"></i>
              <div class="ui tiny corner label">
                <i class="icon asterisk"></i>
              </div>
            </div>
          </div>

            <div class="field">
            <div class="ui left icon big input">
              <input name="email" type="text" placeholder="Email" value="{!!Input::old('email')!!}" readonly onfocus="this.removeAttribute('readonly');">
              <i class="mail icon"></i>
              <div class="ui tiny corner label">
                <i class="icon asterisk"></i>
              </div>
            </div>
          </div>

          <div class="field">
            <div class="ui left icon big input">
              <input name="password" type="password" placeholder="Password" readonly onfocus="this.removeAttribute('readonly');">
              <i class="lock icon"></i>
              <div class="ui tiny corner label">
                <i class="icon asterisk"></i>
              </div>
            </div>
          </div>

          <div class="field">
            <div class="ui left icon big input">
              <input name="first_name" type="text" placeholder="First Name" value="{!!Input::old('first_name')!!}">
              <i class="info icon"></i>
              <div class="ui tiny corner label">
                <i class="icon asterisk"></i>
              </div>
            </div>
          </div>

          <div class="field">
            <div class="ui left icon big input">
              <input name="last_name" type="text" placeholder="Last Name"value="{!!Input::old('last_name')!!}">
              <i class="info icon"></i>
              <div class="ui tiny corner label">
                <i class="icon asterisk"></i>
              </div>
            </div>
          </div>
 
            {!! Form::submit("Register",[
              'class' => 'ui big fluid teal button'
            ]) !!}

              <div class="ui horizontal divider">Or</div>


          <a href="/social/auth/redirect/facebook" id="fb_login_btn" class="ui big fluid icon facebook button" value="Login wit facebook"><i class="facebook icon"></i>Login with facebook</a>

        {!! Form::close() !!}

</div> <!-- /container -->
</div>
</div>

@stop
