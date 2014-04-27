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
			  	Wastefullness Leaderboard 
			  </h3>
		  </div>
		  <div class="col-md-6 col-md-offset-3">
			<ul class="list-group" style="min-height: 300px;">
				@foreach ($users as $user)
					<li class="list-group-item">
						<span class="badge" style="color:#d5334b; background-color:white; font-size:16px;">{{$user->carbon}} kgCO2</span>
						{{ $user->name }}
					</li>
				@endforeach  
			</ul>
			  

			
		  </div>
	  </div>
@stop