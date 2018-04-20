@extends('user.layouts.layout')

@section('title')
{{-- here goes the title of the page --}}
	Home Page
@endsection

@section('head')
	{{-- this is for the css of this page --}}
@endsection

@section('body')
<div class="card p-3 p-md-5 text-white bg-dark" style="background-image: url({{ asset('/user_styles/images/back.jpeg') }});  no-repeat center center fixed;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		height:600px;

		" >
		<div class="container">
		<div class="col-md-6 px-0">
			<h1 class="display-4 font-italic">Title of a longer featured blog post</h1>
			<p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what's most interesting in this post's contents.</p>
			@guest
				<a class="btn btn-lg btn-info" href="{{ route('login') }}" >Log in</a>
			@endguest
			<br/>
			@auth
			<a class="btn btn-lg btn-info" href="{{ route('reservations.create') }}" style="margin-top: 20px" > Make an appointment</a>
            @endauth
		</div>
		</div>
	</div>

	<!--About Us-->
	<div class="container mt-5 mb-5 text-center">
		<h1 >
			<strong> About </strong>
			<strong style="color: #3ea2b8">Us </strong>
		</h1>
		 <p>
			Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown...

			Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer.
		 </p>
	</div>

	<!--Statistics -->
	<div class="card" style="background-image: url({{ asset('/user_styles/images/pattern.jpg') }}); background-attachment: fixed;">
		<div class=" text-white" style="background-color: #17a2b8cc !important">
			<div class="container text-center pt-5 pb-5">
				<div class="row">
					<div class="col-sm-4">
						<i class="fa fa-building fa-3x pr-2"></i>
						<strong class="timer" style="font-size: 40px"> 10 </strong>
						<div>
						 <strong style="font-size: 25px"> Clinics </strong>
						</div>
					</div>
					<div class="col-sm-4">
						<i class="fa fa-users fa-3x pr-2"></i>
						<strong class="timer" style="font-size: 40px" > 7340 </strong>
						<div>
						 <strong style="font-size: 25px"> Happy Clients </strong>
						</div>
					</div>
					<div class="col-sm-4">
						<i class="fa fa-heartbeat fa-3x pr-2"></i>
						<strong class="timer" style="font-size: 40px"> 4320 </strong>
						<div>
						 <strong style="font-size: 25px"> Operations </strong>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--Our Services-->
		<!--Paragraph-->
	<div class="container mt-5 mb-5 text-center">
		<h1 >
			<strong> Our Best </strong>
			<strong style="color: #3ea2b8">Services</strong>
		</h1>
		 <p>
			Lorem Ipsum is simply dummy text of the printing and typesetting industry has been the industry's standard dummy text ever since the been when an unknown printer.
		 </p>
	</div>

		<!-- services -->
	<div class="card-group mt-5 mb-5 mr-5 ml-5">
	  <div class="card mr-3 ml-3">
	    <img class="card-img-top" src="{{ asset('/user_styles/images/Dental Fillings.jpg') }}" alt="Card image cap">
	    <div class="card-body">
	      <h5 class="card-title">Dental Fillings</h5>
	      <p class="card-text">Lorem ipsum dolor Fusce varius euismod lacus eget feugiat rorem ipsum dolor consectetur Fusce varius [...] </p>
	      
	    </div>
	  </div>
	  <div class="card mr-3 ml-3">
	    <img class="card-img-top" src="{{ asset('/user_styles/images/Orthodontics.jpg') }}" alt="Card image cap">
	    <div class="card-body">
	      <h5 class="card-title">Orthodontics</h5>
	      <p class="card-text">Lorem ipsum dolor Fusce varius euismod lacus eget feugiat rorem ipsum dolor consectetur Fusce varius [...] </p>
	      
	    </div>
	  </div>
	  <div class="card mr-3 ml-3">
	    <img class="card-img-top" src="{{ asset('/user_styles/images/Tooth Extraction.jpg') }}" alt="Card image cap">
	    <div class="card-body">
	      <h5 class="card-title">Tooth Extraction</h5>
	      <p class="card-text">Lorem ipsum dolor Fusce varius euismod lacus eget feugiat rorem ipsum dolor consectetur Fusce varius [...] </p>
	      
	    </div>
	  </div>
	</div>

	<div class="card-group  mb-5 mr-5 ml-5">
	  <div class="card mr-3 ml-3">
	    <img class="card-img-top" src="{{ asset('/user_styles/images/Root Canal Treatment.jpg') }}" alt="Card image cap">
	    <div class="card-body">
	      <h5 class="card-title">Root Canal Treatment</h5>
	      <p class="card-text">Lorem ipsum dolor Fusce varius euismod lacus eget feugiat rorem ipsum dolor consectetur Fusce varius [...] </p>
	      
	    </div>
	  </div>
	  <div class="card mr-3 ml-3">
	    <img class="card-img-top" src="{{ asset('/user_styles/images/Teeth Whitening.jpg') }}" alt="Card image cap">
	    <div class="card-body">
	      <h5 class="card-title">Teeth Whitening</h5>
	      <p class="card-text">Lorem ipsum dolor Fusce varius euismod lacus eget feugiat rorem ipsum dolor consectetur Fusce varius [...] </p>
	      
	    </div>
	  </div>
	  <div class="card mr-3 ml-3">
	    <img class="card-img-top" src="{{ asset('/user_styles/images/Routine Dental Exam.jpg') }}" alt="Card image cap">
	    <div class="card-body">
	      <h5 class="card-title">Routine Dental Exam</h5>
	      <p class="card-text">Lorem ipsum dolor Fusce varius euismod lacus eget feugiat rorem ipsum dolor consectetur Fusce varius [...] </p>
	      
	    </div>
	  </div>
	</div>

	<!--Our Doctors-->
		<!--Paragraph-->
	<div class="container mt-5 mb-5 text-center">
		<h1 >
			<strong> Meet Our </strong>
			<strong style="color: #3ea2b8">Doctors</strong>
		</h1>
		 <p>
			Lorem Ipsum is simply dummy text of the printing and typesetting industry has been the industry's standard dummy text ever since the been when an unknown printer.
		 </p>
	</div>

		<!-- Doctors -->
	<div class="card-group mt-5 mb-5 mr-5 ml-5">
	  <div class="card mr-3 ml-3">
	    <img class="card-img-top" src="{{ asset('/user_styles/images/Dr1.jpg') }}" alt="Card image cap">
	    <div class="card-body">
	      <h5 class="card-title text-center">Jonathan Smith</h5>
	      <p class="card-text">Lorem ipsum dolor Fusce varius euismod lacus eget feugiat rorem ipsum dolor consectetur Fusce varius [...] </p>
	      
	    </div>
	  </div>
	  <div class="card mr-3 ml-3">
	    <img class="card-img-top" src="{{ asset('/user_styles/images/Dr2.jpg') }}" alt="Card image cap">
	    <div class="card-body">
	      <h5 class="card-title text-center">Fahima Zerin</h5>
	      <p class="card-text">Lorem ipsum dolor Fusce varius euismod lacus eget feugiat rorem ipsum dolor consectetur Fusce varius [...] </p>
	      
	    </div>
	  </div>
	  <div class="card mr-3 ml-3">
	    <img class="card-img-top" src="{{ asset('/user_styles/images/Dr3.jpg') }}" alt="Card image cap">
	    <div class="card-body">
	      <h5 class="card-title text-center">Alex Morfiee</h5>
	      <p class="card-text">Lorem ipsum dolor Fusce varius euismod lacus eget feugiat rorem ipsum dolor consectetur Fusce varius [...] </p>
	      
	    </div>
	  </div>
	  <div class="card mr-3 ml-3">
	    <img class="card-img-top" src="{{ asset('/user_styles/images/Dr4.jpg') }}" alt="Card image cap">
	    <div class="card-body">
	      <h5 class="card-title text-center">Rebecca Martin</h5>
	      <p class="card-text">Lorem ipsum dolor Fusce varius euismod lacus eget feugiat rorem ipsum dolor consectetur Fusce varius [...] </p>
	      
	    </div>
	  </div>
	</div>
@endsection




@section('footer')
{{-- here goes the js of the page --}}
<script src="{{ asset('/user_styles/js/jquery.countTo.js') }}"></script>
<script>
	$('.timer').each(function(index, el) {
		$(this).countTo({from: 0, to: $(this).text()})
	});
</script>
@endsection
