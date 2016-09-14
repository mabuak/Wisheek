@extends('layouts.master')
@section('content')
@include('includes.header')


<div class="pad wrapper">
<div class="container ct">

@include ('utils/errors')


<div class="ui massive fluid action input" id="new_pin_input">
    <input type="text" placeholder="Paste URL">
    <div id="new_pin_btn" class="ui teal button">Search</div>
</div>

<div class="ui centered inline loader"></div>

<div id="new_pin_price_div">
	<div class="header">Wish price</div>
	<div id="dragdeal" class="dragdealer">
  			<div class="handle red-bar">New price</div>
	</div>
</div>

<ul class="pins grid special cards" id="new_pins">

</ul>

@stop