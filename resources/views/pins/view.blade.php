@extends('layouts.master')
@section('content')
@include('includes.header')

<div class="pad wrapper">
<div class="container ct">

<div class="pin @if ($pin->actual_price && $pin->want_price >= $pin->actual_price) pulse @endif" data-id="{!!$pin->id!!}">

	<div class="ui special card">
		<div class="blurring dimable image">

			<div class="ui dimmer">
        		<div class="content">
          			<div class="center">
            			<a href="pin/{!!$pin->hash!!}" class="ui inverted blue button edit_pin">Edit pin</a>
            			<div class="ui inverted red button delete_pin">Delete pin</div>
          			</div>
        		</div>
      		</div>

			@if ($pin->actual_price && $pin->want_price >= $pin->actual_price)
			<a class="ui green large ribbon label">Nice Price !</a>
			@endif

			<img src="{!!$pin->image!!}" />

		</div>

		<div class="content">

		    <a href="{!!$pin->url!!}" class="header" target="_blank">{!!$pin->title!!}</a>
		    <div class="meta">
		      	<span class="date">{!! DateHelper::timeago($pin->created_at) !!} ago</span>
		    </div>

			<div class="prices">
				<div class="price">Original price<div class="ui tag blue right floated label">{!!$pin->price!!}</div></div><br/>
				<div class="want_price">Wish Price<div class="ui tag green right floated label">{!!$pin->want_price!!}</div></div><br/>
				<div class="actual_price">Actual price
					@if (isset($pin->actual_price)) 
					<div class="ui tag teal right floated label">@if (isset($pin->actual_price)) {!!$pin->actual_price!!} @else Loading @endif</div><br/>
					@else
					<div class="ui tag disabled right floated label">@if (isset($pin->actual_price)) {!!$pin->actual_price!!} @else Loading ... @endif</div><br/>
					@endif
				</div>
			</div>
			<br />
			<div>
				<div id="dragdeal" class="dragdealer">
  					<div class="handle red-bar">New price</div>
				</div>
			</div>

		</div>
	</div>

</div>

</div>
</div>
@stop