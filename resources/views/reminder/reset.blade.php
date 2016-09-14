@extends("layouts.master")
@section("content")

@include('includes.header')

<div class="pad wrapper">
<div class="container ct">

    <h2 class="ui header">Enter new password</h2>
    @if (session('success'))

    <div class="ui icon success message">
    <i class="inbox icon"></i>
    <div class="content">
      <div class="header">
        Check your email
      </div>
      <p>Check you email inbox for further instructions</p>
    </div>
    </div>

    @else

    @include ('utils/errors')

    @endif

    {!! Form::open([
        "class" => "ui large form segment small_form",
    ]) !!}

    {!! Form::hidden('token',$token) !!}

  <div class="field">
    <div class="ui big left icon input">
      <input name="password" type="password" placeholder="New password">
      <i class="lock icon"></i>
      <div class="ui corner label">
        <i class="icon asterisk"></i>
      </div>
    </div>
  </div>

    <div class="field">
    <div class="ui big left icon input">
      <input name="password_confirmation" type="password" placeholder="New password again">
      <i class="lock icon"></i>
      <div class="ui corner label">
        <i class="icon asterisk"></i>
      </div>
    </div>
  </div>

    {!! Form::submit("Reset", [
            'class' => 'ui big fluid teal submit button'
        ]) !!}
    {!! Form::close() !!}

</div> <!-- /container -->
</div>

@stop