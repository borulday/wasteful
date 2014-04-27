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
		  <div class="col-md-10 col-md-offset-1">
			  <h3 style="margin-top:5%;">			  
			  	Select the foods you wasted today : 
			  </h3>
		  </div>
		  <div class="col-md-10 col-md-offset-1">
			<div class="row">
				<form id="itemform" name="itemform" method="post" action="http://local.bunuye.com/items/send" accept-charset="utf-8">
				  	@foreach ($items as $it)
						<div class="col-md-3" style="margin:5% auto 3% auto;">
							<img src="/see/images/{{$it->id}}.png" style="width:100%;"/>
							<div class="caption">
								<h3 class="text-right">{{ $it->name }}</h3>
								<p>
									<div class="col-md-5 col-md-offset-4" style="padding-right: 0;">
										<input id="item-{{ $it->id }}" name="item-{{ $it->id }}" itemID="{{ $it->id }}" type="text" value="" class="form-control" placeholder="0.0" />
									</div>
									<div class="col-md-3 text-right" style="margin-top:4px; color:#474a82; font-size:18px; padding:0;">
										{{ $it->units }}
									</div>
								</p>
							</div>
						</div>
					@endforeach 
					<div class="col-md-1 col-md-offset-11" style="margin-bottom:50px !important;">
					  	<button id="submitButton" type="submit" class="btn btn-primary btn-lg">
							NEXT >
						</button>
					 </div>

				</form>

			</div>
			
		  </div>
	  </div>
	  <script type="text/javascript">
			// $( "#submitButton" ).click(function() {
			// 	$( "#itemform" ).submit();
			// });
	 //  	var datas = new Array();
		// function showMe(e) {
		// 	// i am spammy!
		// 	// alert(e.value);
		// 	var attrs = e.id.split("-");
		// 	// console.log(attrs[1]);
		// 	datas[attrs[1]] = e.value;
		// 	console.log(datas);
		// }
	  </script>
@stop