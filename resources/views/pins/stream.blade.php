@if ($stream->count() > 0)
<div class="ui active centered inline loader"></div>

<ul class="pins grid special cards" id="stream">


@foreach ($stream as $key=>$pin)
	@include('pins.pin')
@endforeach

</ul>

<div class="paginate hiden">
{!! $stream->render() !!}
</div>

@if ($stream->lastPage()>1)
<div class="ct">
    <div class="ui button teal more_posts">More Posts ...</div>
</div>
@endif

@else
<div id="no_pins_div" class="fouc ct">
<div>You have no pins yet</div><br />
<a href="pin/create" class="ui blue huge button"><i class="plus icon"></i>New pin</a>
</div>
@endif