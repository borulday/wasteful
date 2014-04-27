<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>How wasteful you are?</title>

    <!-- Bootstrap -->
    <link href="/see/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	@yield('content')
  	
	<div style="width:100%; height:80px; background-color:#2b2c3e; bottom:0;"> <!-- position:fixed; -->
		<div class="col-md-8 col-md-offset-2">
			<div style="color:white; padding-top: 30px;">&copy; Copyright 2014 Wasteful</div>
		</div>
	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/see/js/bootstrap.min.js"></script>
    <script src="/see/js/jquery.js"></script>

  </body>
</html>