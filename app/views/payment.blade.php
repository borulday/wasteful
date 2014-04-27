@extends('hello')
@section('content')
	  <div class="navbarSp" style="width:100%; padding:2% 10%; background-color:#10bac3; overflow:hidden;">
		  <div class="col-md-9">
	    	  <a class="" href="/" style="text-decoration:none;"><h2 style="color:white;">WASTEFUL </h2></a>
		</div>
		<div class="col-md-3" style=" margin-top:20px; text-align:right;">
			<a href="/leaderboard" style="font-size:16px; color:white; text-decoration:underline;">Leaderboard</a>
			<div style="width:30px;"></div>
			<a href="/profile" style="font-size:16px; color:white; text-decoration:underline;">Profile</a>
		</div>
	  </div>
	  
	  <div class="container">
		  <div class="col-md-10 col-md-offset-1 text-center">
			  <h3 style="margin:5% auto;">

			  	<div class="col-md-6 col-md-offset-3" style="padding:2% 0;">
			  		<div><h1>Thanks for your donations! </h1></div>
			  	</div>
			  	<div class="col-md-4 col-md-offset-4" style="padding:0;">
					<img src="/see/images/bear.png" style="width:100%;"/>
				</div>
				<div class="col-md-6 col-md-offset-3">
				  	<h3>ID:{{$paymentID}}</h3><br/>
			  	</div>
			  </h3>
		  </div>
	  </div>
@stop