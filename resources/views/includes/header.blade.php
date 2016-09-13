<div id="header"> 
@if (Auth::check())

    <a href="/" class="fouc" id="header_logo">Wisheek</a> 

    <div id="header_buttons">
      <a class="ui tiny blue button" href="/pin/create"><i class="plus icon"></i>New pin</a> 
      <a class="ui tiny red button" href="/logout">Logout</a> 
    </div>
@else

  <div id="header_buttons">
      <a class="ui tiny blue button" href="/login">Login</a> 
      <a class="ui tiny orange button" href="/register">Register</a> 
    </div>
@endif
 </div>
