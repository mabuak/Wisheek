<div id="header"> 
@if (Auth::check())
    <i class="icon big content" id="sidebar_handle"></i>

    <a href="/" class="fouc" id="header_logo">Wisheek</a> 

    <div id="header_buttons">
      <a class="ui tiny teal button" href="/pin/create"><i class="plus icon"></i>New pin</a> 
      <a class="ui tiny teal button" href="/logout">Logout</a> 
    </div>
@else

    <i class="icon content"></i>
    <a href="/" class="fouc" id="header_logo">Wisheek</a> 

  <div id="header_buttons">
      <a class="ui tiny blue button" href="/login">Login</a> 
      <a class="ui tiny orange button" href="/register">Register</a> 
    </div>
@endif
</div>
