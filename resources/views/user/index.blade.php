@extends('user.layouts.layout')

@section('title')
{{-- here goes the title of the page --}}
	Home Page
@endsection

@section('head')
	{{-- this is for the css of this page --}}
@endsection

@section('body')
{{-- here goes the content of the page --}}
	<div class="card" style="background-image: url({{ asset('/user_styles/images/pattern.jpg') }});">
		<div class=" text-white" style="background-color: #17a2b8b3 !important">
			<div class="container text-center pt-5 pb-5">
				<div class="row">
					<div class="col-sm-4">
						<i class="fa fa-building fa-3x pr-3"></i>
						<strong style="font-size: 50px"> 10 </strong>
						<div> <strong style="font-size: 20px"> Clinics </strong></div>
					</div>
					<div class="col-sm-4">
						<i class="fa fa-users fa-3x"></i>
					</div>
					<div class="col-sm-4">
						<i class="fa fa-heartbeat fa-3x"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('footer')
{{-- here goes the js of the page --}}
@endsection