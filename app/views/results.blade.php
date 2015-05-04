@extends('hello')
@section('content')

	  <div class="navbarSp" style="width:100%; padding:2% 10%; background-color:#10bac3; overflow:hidden;">
		  <div class="col-md-9 col-sm-9">
	    	  <a class="" href="/" style="text-decoration:none;"><h2 style="color:white;">WASTEFUL </h2></a>
		</div>
		<div class="col-md-3 col-sm-3" style=" margin-top:20px; text-align:right;">
			<a href="/leaderboard" style="font-size:16px; color:white; text-decoration:underline;">Leaderboard</a>
			<div style="width:30px;"></div>
			<a href="/profile" style="font-size:16px; color:white; text-decoration:underline;">Profile</a>
		</div>
	  </div>
	  
	  <div class="container">
		  <div class="col-md-10 col-md-offset-1">
			  
			  <div class="col-md-12" style="background-color:#f6eb60; width:100%; margin-top:5%; padding:2%; border-radius:5px;">
			  <div class="col-md-12" style="margin-bottom:20px;">
				  <div class="col-md-2 col-md-offset-1	" style="height:20%; margin-top:20px;">
				  	<img src="/see/images/adam.png" style="width:19px; height:50px;"/>
				  	<img src="/see/images/adam.png" style="width:19px; height:50px;"/>
				  	<img src="/see/images/adam.png" style="width:19px; height:50px;"/>
				  	<img src="/see/images/adam.png" style="width:19px; height:50px;"/>
				  	<img src="/see/images/adam.png" style="width:19px; height:50px;"/>
					<!-- eğer 5 den az body varsa margin top 25 gelcek dive -->
				  </div>
			  		<div class="col-md-9">
  			  			<h2 style="margin-top:3%;">You wasted <span style="font-size:40px; color:#d5334b">{{$person}}</span> people's food. :( 
					</div>		
			  </div>
		  	  </div>
			  
			  <div class="col-md-12" style="background-color:#f6eb60; width:100%; margin-top:5%; padding:2%; border-radius:5px;">
			  <div class="col-md-12" >
				  <div class="col-md-2 col-md-offset-1" style=" height:20%; background-color:#d5334e; border-radius:50%;">
				  	<img src="/see/images/foots.png" style="width:80%; margin:10%;"/>
				  </div>
			  		<div class="col-md-9">
  			  			<h2 style="margin-top:5%;">Your carbon footprint is <span style="font-size:40px; color:#d5334b">{{$carbon}}kgCO2</span>.</h2>
					</div>		
			  </div>
		  	  </div>
			  
			  <div class="col-md-10" style="margin-top:5%;">
				  <div class="col-md-8 text-right col-md-offset-2">
					<div style="font-size:20px;">Do you want to adopt a polar bear and reduce the damage you have caused?</div>
				  </div>
				  <div class="col-md-2 text-right">
					<a href="http://www.wwf.org.tr/sizneyapabilirsiniz/evlat_edinin2/" target="_blank">
						<button type="button" class="btn btn-success btn-lg">
							<span class="glyphicon glyphicon-heart"></span>
							<span class="glyphicon glyphicon-heart"></span>
							ADOPT
						</button>
					</a>
				  </div>
			  </div>

			  <div class="col-md-12" style="margin-top:5%;" id="gel">			 
	  			<div class="row">
			  
	  			  <div class="col-md-3" style="margin:5% auto 3% auto;">
	  			      <img src="/see/images/bear2.png" style="width:100%;"/>
	  			  </div>
	  			  <div class="col-md-3" style="margin:5% auto 3% auto;">
	  			      <img src="/see/images/bear.png" style="width:100%;"/>
	  			  </div>
	  			  <div class="col-md-3" style="margin:5% auto 3% auto;">
	  			      <img src="/see/images/bear3.png" style="width:100%;"/>
	  			  </div>
	  			  <div class="col-md-3" style="margin:5% auto 3% auto;">
	  			      <img src="/see/images/bear4.png" style="width:100%;"/>
	  			  </div>
			  
	  			</div>
			  </div>


			  <div class="col-md-10" style="margin-top:5%; margin-bottom:7%;">
				  <div class="col-md-8 text-right col-md-offset-2">
					<div style="font-size:20px;">Do you want to adopt a polar bear and reduce the damage you have caused?</div>
				  </div>
				  <div class="col-md-2 text-right">
					<a href="http://www.wwf.org.tr/sizneyapabilirsiniz/evlat_edinin2/" target="_blank">
						<button type="button" class="btn btn-success btn-lg">
							<span class="glyphicon glyphicon-heart"></span>
							<span class="glyphicon glyphicon-heart"></span>
							ADOPT
						</button>
					</a>
				  </div>
			  </div>
			  

		  </div>
	  </div>
	  <script type="text/javascript">
	  	function pay(pay) {
	  		location.href = '/payment/'+pay;
	  	}
	  </script>
	
@stop