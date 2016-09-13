<!DOCTYPE html>
<html>
   
    @include('includes.head')

    <body id="@if (isset($bodyname)){!!$bodyname!!}@endif" data-segment="@if(isset($segment)){!!$segment!!}@endif" data-id="@if(Auth::check()){!!Auth::user()->id!!}@endif" data->

    <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1155304917876435',
      xfbml      : true,
      version    : 'v2.7'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

        <div class="push">
			@yield('content')
  		</div>

		@include('includes.footer')

    </body>
</html>