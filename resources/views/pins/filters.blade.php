	<div id="filters">
	<div class="ui fluid vertical menu">
  <a class="teal item">
    All product pins
    <div class="ui teal label">{!!$stream->count()!!}</div>
  </a>
  <a id="filter_nice" class="filter item" data-filter="nice" data-value='1'>
    <text>Nice price product pins</text>
    @if ($stream->where('actual_price','<=','wish_price')->where('actual_price','is not','null')->count() > 0)
    <div class="ui green label">{!!$stream->where('actual_price','<=','wish_price')->count()!!}</div>
    @endif
  </a>

   <div class="header item">Sorty by</div>
     <a class="active item sort" data-order="desc" data-sort="created_at">Date<i class="icon down chevron"></i></a>
     <a class="item sort" data-order="asc" data-sort="actual_price">Price<i class="ui hidden icon down chevron"></i></a>

 

  <div class="item">
    <div class="ui transparent icon input" id="f_search">
      <input type="text" placeholder="Search pins..." data-filter="search" data-value="1">
      <i class="search icon"></i>
    </div>
  </div>
</div>

</div>