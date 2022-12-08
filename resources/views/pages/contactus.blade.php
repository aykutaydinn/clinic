@extends('layouts.app')
<link rel="stylesheet" href="/css/contact.css">

@section('content')
<script>
	Intercom('trackEvent', 'test-occurred');
</script>

<div class="container animated fadeIn">

  <div class="row">
    <h1 class="header-title"> Contact </h1>
    <hr>
  </div>

  <div class="container second-portion">
	<div class="row">
    	<div class="col-xs-12 col-sm-6 col-lg-4">
			<div class="box">							
				<div class="icon">
					<div class="image"><i class="fa fa-envelope" aria-hidden="true"></i></div>
					<div class="info">
						<h3 class="title">EMAIL</h3>
						<p>
                        <br>
							<i class="fa fa-envelope" aria-hidden="true"></i> &nbsp info@myclinic.com.au
							<br>
						</p>
					
					</div>
				</div>
				<div class="space"></div>
			</div> 
		</div>
			
        <div class="col-xs-12 col-sm-6 col-lg-4">
			<div class="box">							
				<div class="icon">
					<div class="image"><i class="fa fa-mobile" aria-hidden="true"></i></div>
					<div class="info">
						<h3 class="title">CONTACT</h3>
    					<p>
                        <br>
							<i class="fa fa-mobile" aria-hidden="true"></i> &nbsp 02 5555 5555
							<br>
							
						</p>
					</div>
				</div>
				<div class="space"></div>
			</div> 
		</div>
			
        <div class="col-xs-12 col-sm-6 col-lg-4">
			<div class="box">							
				<div class="icon">
					<div class="image"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
					<div class="info">
						<h3 class="title">ADDRESS</h3>
    					<p>
							 <i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp 160 Sussex St, Sydney NSW 2000
							 
						</p>
					</div>
				</div>
				<div class="space"></div>
			</div> 
		</div>		    
	    
	</div>
</div>

</div>
@endsection