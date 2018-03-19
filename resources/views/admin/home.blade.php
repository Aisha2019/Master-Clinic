@extends('admin.layouts.layout')

@section('title')
	{{-- here goes the title of page --}}
	Admin home
@endsection

@section('css')
	{{-- here goes the css of page --}}
@endsection

@section('body')
	{{-- here goes content of pages --}}
	Hi!! this is admin home page
	@if (session('status'))
		<div class="alert alert-success">{{ session('status') }}</div>
	@endif
@endsection

@section('js')
	{{-- here goes js files --}}
@endsection