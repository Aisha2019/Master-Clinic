<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	@include('user.layouts.head')
<body style="margin-top: 55px; height: 5000px">
	@include('user.layouts.navbar')
	
	@section('body')
		@show
	@include('user.layouts.footer')
	@include('user.layouts.scrollTop')
</body>
</html>