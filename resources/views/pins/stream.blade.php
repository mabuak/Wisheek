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