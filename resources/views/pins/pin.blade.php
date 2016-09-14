<li class="pin @if ($pin->actual_price && $pin->want_price >= $pin->actual_price) pulse @endif" data-id="{!!$pin->id!!}" data-price="{!!$pin->price!!}">
	
	<div class="ui special card">
		<div class="blurring dimable image">

			<div class="ui dimmer">
        		<div class="content">

          			<div class="center">
          				@if (isset($editmode) && $editmode)
            			<div class="ui inverted green button save_edit_pin_btn">Save pin</div>
          				@else
            			<a href="pin/{!!$pin->hash!!}/edit" class="ui inverted blue button edit_pin">Edit pin</a>
            			<div class="ui inverted red button delete_pin">Delete pin</div>
            			@endif
          			</div>
        		</div>
      		</div>

			

			<img src="{!!$pin->image!!}" />
			@if ($pin->actual_price && $pin->want_price >= $pin->actual_price)
			<a class="ui green large ribbon label">Nice Price !</a>
			@endif
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

			@if (isset($editmode) && $editmode)
			<div>
				<div id="dragdeal" class="dragdealer">
  					<div class="handle red-bar" style="left: 0px;">New price</div>
				</div>
			</div>
			@endif
		</div>
	</div>


</li>