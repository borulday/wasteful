@extends('hello')
@section('content')

	  <div class="navbarSp" style="width:100%; padding:2% 10%; background-color:#10bac3; overflow:hidden;">
		  <div class="col-md-9">
	    	  <a class="" href="/" style="text-decoration:none;"><h2 style="color:white;">WASTEFUL </h2></a>
		</div>
		<div class="col-md-3" style="margin-top:20px; text-align:right;">
			<div style="background:url('/see/images/fblogin.png'); width:218px; height:40px; cursor:pointer;" onclick="connect();">
			</div>
		</div>
	  </div>
	  
	  <div class="container" style="background:url('/see/images/ekmek.png'); width:100%;">
		  <div class="col-md-8 col-md-offset-2	">
			  <h2 class="text-center" style="line-height:35px; margin:15% auto 10%; color:#fff;"> Did you finished your plate today? If not, see how much carbon gas emission it caused. </h2	>
			  <div class="col-md-8 col-md-offset-2 text-center" style="height:265px;">
			  	<button type="button" class="btn btn-warning btn-lg">
					<span class="glyphicon glyphicon-globe"></span>
					LETS LEARN YOUR CARBON FOOTPRINT
				</button>
			</div>
		  </div>
	  </div>
	  <script type="text/javascript">
	  function connect() {
	  	location.href = '/fb';
	  }
	  </script>
@stop