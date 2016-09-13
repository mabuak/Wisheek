<li class="new pin" data-price={!!$pin['price']!!} data-store={!!$pin['store']!!} data-url={!!$pin['url']!!} data-image={!!$pin['image']!!} data-hash={!!$pin['hash']!!}>
	
	<div class="ui special card">
		<div class="blurring dimable image">

			<div class="ui dimmer">
        		<div class="content">
          			<div class="center">
            			<div class="ui inverted green button save_pin_btn">Save pin</div>
          			</div>
        		</div>
      		</div>

			<img src="{!!$pin['image']!!}" />

		</div>

		<div class="content">

		    <a class="header" target="_blank">{!!$pin['title']!!}</a>

			<div class="prices">
				<div class="price">Original price<div class="ui tag blue right floated label">{!!$pin['price']!!}</div></div><br/>
				<div class="want_price">Wish Price<div class="ui tag green right floated label">0</div></div><br/>
	
			</div>
		</div>
	</div>


</li>