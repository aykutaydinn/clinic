<!DOCTYPE html>
<html lang="en"> 
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>MyClinic</title>
	<link rel="stylesheet" href="/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.css" integrity="sha512-4S7w9W6/qX2AhdMAAJ+jYF/XifUfFtrnFSMKHzFWbkE2Sgvbn5EhGIR9w4tvk0vfS1hKppFIbWt/vdVIFrIAKw==" crossorigin="anonymous" />
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/style.css">
	<script src="https://kit.fontawesome.com/6aa971b84c.js" crossorigin="anonymous"></script>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,800,700,300' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=BenchNine:300,400,700' rel='stylesheet' type='text/css'>
	
<!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
@auth
	<script>
	var count = Number(localStorage.getItem('count')) || 0;
	intercomSettings = {
		app_id: "ayir2oly",
		name: <?php echo json_encode(Auth::user()->name) ?>, // Full name
		user_id: "<?php echo Auth::user()->id ?>",
		email: <?php echo json_encode(Auth::user()->email) ?>,
		custom_launcher_selector:'#my_custom_link'
	};
	</script>

	<script>
	// We pre-filled your app ID in the widget URL: 'https://widget.intercom.io/widget/ayir2oly'
	(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/ayir2oly';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(document.readyState==='complete'){l();}else if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
	
	</script>
	@else
	<script>
		//Set your APP_ID
		var APP_ID = "ayir2oly";

		window.intercomSettings = {
			app_id: APP_ID
		};
		(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/' + APP_ID;var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);};if(document.readyState==='complete'){l();}else if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();

		
	</script>
@endif
	
	<!-- ====================================================
	header section -->
	<header class="top-header">
		<div class="container">
			<div class="row">
				<div class="col-xs-5 header-logo">
					<br>
					<a href="/"><img src="/img/logo3.png" alt="" class="img-responsive logo"></a>
				</div>

				<div class="col-md-7">
					<nav class="navbar navbar-default">
					  <div class="container-fluid nav-bar">
					    <!-- Brand and toggle get grouped for better mobile display -->
					    <div class="navbar-header">
					      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					        <span class="sr-only">Toggle navigation</span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					      </button>
					    </div>

					    <!-- Collect the nav links, forms, and other content for toggling -->
					    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					      
					      <ul class="nav nav-pills navbar-right" style="font-size: 20px;">
					        <li><a class="menu" id="my_custom_link" href="#" onclick="Intercom('show')">Home</a></li>
                            <li><a class="menu" href="/appointment" >Book Appointment</a></li>
                            <li><a class="menu" href="/contactus">Contact Us</a></li>
                            <li><a class="menu" href="/about" onClick="updateIt()">About Us</a></li>
							@auth
                            <li><a class="menu " href="{{ route('login') }}" class="text-sm text-gray-700 underline">Account</a>
							<li><a class="menu " href="{{ route('logout') }}" class="text-sm text-gray-700 underline">Logout</a>
                            @else
                            <li><a class="menu " href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>
                            @endif
                          </ul>
                          
                          <div>

					    </div><!-- /navbar-collapse -->
					  </div><!-- / .container-fluid -->
					</nav>
				</div>
			</div>
		</div>
    </header> <!-- end of header area -->


    @yield('content')



    <footer class="footer clearfix">
		<div class="container">
			<div class="row">
				<div class="col-xs-6 footer-para">
					<p>&copy;MyClinic All right reserved</p>
				</div>
				<div class="col-xs-6 text-right">
				</div>
			</div>
		</div>
</footer>

	<!-- script tags
	============================================================= -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js" integrity="sha512-ux1VHIyaPxawuad8d1wr1i9l4mTwukRq5B3s8G3nEmdENnKF5wKfOV6MEUH0k/rNT4mFr/yL+ozoDiwhUQekTg==" crossorigin="anonymous"></script>
	
	
	</div>

	<script>
		function increase(){
			localStorage.setItem('count', count + 1);
			count = Number(localStorage.getItem('count')) || 0;
			return count;
		}

		const queryString = window.location.search;
		const urlParams = new URLSearchParams(queryString);
		const test = urlParams.get('test')
		if (test == "error"){
			Intercom('startTour', 388087);
		}

		function updateIt(){
			Intercom('update', {"Test2": "aykkkk"});
		}

		

</script>
</body>
</html>