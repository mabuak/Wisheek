@extends('layouts.master')
@section('content')

<div id="landing_header">
    <a class="ui label" href="/login">Login</a> 
	<a class="ui label" href="/register">Register</a>
</div>

<div class="teal cover wrapper">

<div id="landing_buttons">
	<a class="ui inverted button" href="/login">Login</a> 
	<a class="ui inverted button" href="/register">Register</a>
</div>


<div class="container ct va">


	<div class="fouc" id="logo">Wisheek</div>

	<div class="fouc" id="slogan_1">Wait for your desired price</div>
	<div class="fouc ct" id="slogan_2">Wisheek is site for everybody who is willing to wait with the purchase. Just save the product pin and wait for the sale notification.</div>

</div>
</div>


<div class="gray wrapper">
<div class="fouc container">

<div id="info_div" class="ui four column center aligned doubling stackable grid">

 <div class="four wide column">
 	<i class="icon massive bullseye"></i>
 	<p>
 		Find the product you want
 	</p>
 </div>
 <div class="four wide column">
 	<i class="icon massive empty heart"></i>
 	<p>
 		Save it as a pin
 	</p>
 </div>
 <div class="four wide column">
 	<i class="icon wait massive"></i>
 	<p>
 		Wait for the sale
 	</p>
 </div>
 <div class="four wide column">
 	<i class="icon massive money"></i>
 	<p>
 		Save money!
 	</p>
 </div>

</div>

</div>
</div>


@stop