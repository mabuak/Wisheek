@extends('layouts.master')
@section('content')
@include('includes.header')



<div class="pad wrapper">
<div class="stream_container">

        @include('pins.stream')

</div>
</div>
@stop