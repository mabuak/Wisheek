@extends('layouts.master')
@section('content')

@include('includes.header')


<div class="wrapper">

<div class="container fh ct">

<div class="am">

@include ('utils/errors')

{!! Form::open([
    'link'        => 'login',
    'autocomplete' => 'on',
    'class' => 'ui large stacked form segment small_form',
]) !!} 

    <div class="field">
      <div class="ui left icon big input">
        <input name="email" type="text" placeholder="Email">
        <i class="user icon"></i>
      </div>
    </div>
  <div class="field">
    <div class="ui left icon big input">
      <input name="password" type="password" placeholder="Password">
      <i class="lock icon"></i>

    </div>
  </div>

  <div class="inline field">
    {!! HTML::linkRoute('remind.getEmail', 'I forgot my password') !!}
  </div>

  <input type="submit" class="ui blue big fluid button" value="Login">
  <div class="ui horizontal divider">
    Or
  </div>
  <a href="/social/auth/redirect/facebook" id="fb_login_btn" class="ui big fluid icon facebook button" value="Login wit facebook"><i class="facebook icon"></i>Login with facebook</a>


{!! Form::close() !!}

</div>
</div>
</div>
@stop
