@if ($stream->count()>0)

	@foreach ($stream as $pin)
			
		@include ('pins/pin')
			
	@endforeach

	<div class="paginate">
		{!! $stream->appends('filters',$filters)->appends('sortBy',$sortBy)->appends('sortOrder',$sortOrder)->render() !!}
	</div>	

	@if ($stream->lastPage()>1)
		<div class="ct">
			<div class="ui teal button" id="more_assets">
				More Pins
			</div>
		</div>
	@endif

@else

	<li class=" ct" id="no_assets_div">

			<i class="massive frown icon"></i>
			<h1 class="ui header">No pins found</h1>

	</li>

@endif

