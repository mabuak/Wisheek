<meta charset="utf-8" />
<meta name="Robots" content="index, follow" />
<meta name="Description" content="Community network for car enthusiasts" />
<meta name="Keywords" content="dog, breed, kennel, social, network, community, dog profiles, dog social, puppies" />	
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf_token" content="{!! csrf_token() !!}">


<title>
@if (isset($pageTitle))
{!!$pageTitle!!}
@else
Wisheek
@endif
</title>

{!! HTML:: style('css/reset.css') !!}
{!! HTML:: style('css/semantic.min.css') !!}
{!! HTML:: style('css/responsive.css') !!}
{!! HTML:: style('css/dragdealer.css') !!}
{!! HTML:: style('css/master.css') !!}

{!! HTML:: script('https://code.jquery.com/jquery-3.0.0.min.js') !!} 
{!! HTML:: script('//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js') !!} 
{!! HTML:: script('js/dragdealer.min.js') !!} 
{!! HTML:: script('js/jquery.masonry.js') !!} 
{!! HTML:: script('js/semantic.min.js') !!} 

<script>
  (function(d) {
    var config = {
      kitId: 'vtr8rzc',
      scriptTimeout: 3000,
      async: true
    },
    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
  })(document);
</script>