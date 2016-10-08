	<div id="leftbar">
	<div class="ui fluid vertical menu">
  <a class="teal item">
    All product pins
    <div class="ui teal label">{!!$stream->count()!!}</div>
  </a>
  <a id="filter_nice" class="item">
    Nice price product pins
    @if ($stream->where('actual_price','<=','wish_price')->count() > 0)
    <div class="ui green label">{!!$stream->where('actual_price','<=','wish_price')->count()!!}</div>
    @endif
  </a>

   <div class="header item">Sorty by</div>
     <a class="active item">Date    <i class="large icon up angle"></i></a>
      <a class="item">Price</a>

 

  <div class="item">
    <div class="ui transparent icon input">
      <input type="text" placeholder="Search pins...">
      <i class="search icon"></i>
    </div>
  </div>
</div>

	</div>