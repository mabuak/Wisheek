@extends('layouts.master')
@section('content')
@include('includes.header')


<div class="pad teal2 wrapper">
<div class="container">

@include ('utils/errors')

<div class="fouc" id="new_pin_caption">
Paste the URL of your product, click search
</div>

<div class="ui massive fluid action input ct" id="new_pin_input">
    <input type="text" placeholder="Paste URL">
    <div id="new_pin_btn" class="ui grey button">Search</div>
</div>

</div>
</div>

<div class="pad wrapper">
<div class="container ct">

<div class="ui centered inline loader"></div>

<div id="new_pin_price_div">
	<div class="header">Wish price</div>
	<div id="dragdeal" class="dragdealer">
  			<div class="handle red-bar">New price</div>
	</div>
</div>

<ul class="pins grid special cards" id="new_pins">

</ul>

</div>
</div>

@stop