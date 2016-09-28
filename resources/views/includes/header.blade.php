<div class="menu" id="header"> 

  <div id="left">

    <i class="item inverted icon large content item" id="sidebar_handle"></i>

  </div>

  <div id="center">
    <a href="/" class="fouc" id="header_logo">Wisheek</a> 
  </div>

  <div id="right">
    <div class="right menu" id="header_buttons">
      @if (Auth::check())
      <a class="item" href="/pin/create" data-tooltip="Create new pin" data-position="bottom center"><i class="add circle large icon" ></i></a>
      <a class="item" href="/logout"><i class="power large icon"></i></a> 
      @else
      <a class="item" href="/login">Login</a> 
      <a class="item" href="/register">Register</a>
      @endif
    </div>
  </div>

</div>
