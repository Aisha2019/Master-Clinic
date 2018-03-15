@extends('user.layouts.layout')

@section('title')
{{-- here goes the title of the page --}}
	User Login
@endsection

@section('head')
	{{-- this is for the css of this page --}}
	<style>
		.pull-right {
			float: right;
		}
	</style>
@endsection

@section('body')
	<div class="container">
		<div class="row full-height align-items-center">
			<div class="col-md-6 ml-auto mr-auto mt-3 mb-3">
				<h2 class="text-center">User Login</h2>
				<form method="POST" action="{{ route('login') }}">
					@csrf
					<div class="form-group">
						<label for="email">Email:</label>
						<input type="email" name="email" placeholder="Type your email" class="form-control">
					</div>
					<div class="form-group">
						<label for="password">Password:</label>
						<input type="password" name="password" placeholder="Type your password" class="form-control">
					</div>
					<div class="form-group">
                        <button type="submit" class="btn btn-info mr-auto">
                            {{ __('Login') }}
                        </button>
                        <a class="btn btn-link pull-right" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
				</form>
			</div>
		</div>
	</div>
@endsection




@section('footer')
{{-- here goes the js of the page --}}

@endsection
