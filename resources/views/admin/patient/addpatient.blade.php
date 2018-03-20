@extends('admin.layouts.layout')

@section('title')

		Register a new client
@endsection

@section('css')
	{{-- here goes the css of page --}}
@endsection

@section('body')
	{{-- here goes content of pages --}}

  <div class="register-box-body">

      @foreach ($errors->all() as $error)
          <div class="alert alert-danger">{{ $error }}</div>
        @endforeach

    <p class="login-box-msg">Register a new patient</p>

    <form  method="post" action="{{ route('admin.patient.add') }}">
      @csrf
      <div class="form-group has-feedback">
        <input type="text" class="form-control" value="{{ old('fullName') }}" placeholder="Full name" name="fullName">
        <span class="form-control-feedback"><i class="fa fa-user"></i></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" value="{{ old('email') }}" name="email">
        <span class="form-control-feedback"><i class="fas fa-envelope"></i></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="form-control-feedback"><i class="fa fa-lock"></i></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password">
        <span class="form-control-feedback"><i class="fa fa-lock"></i></span>
      </div>
       <div class="form-group has-feedback">
        <input type="Mobile" class="form-control" value="{{ old('mobile') }}" placeholder="Mobile" name="mobile">
        <span class="form-control-feedback"><i class="fas fa-mobile-alt"></i></span>
      </div>
        <div class="form-group has-feedback">
        <input type="date" class="form-control" placeholder=" Birthday" value="{{ old('birthday') }}" name="birthday">
        <span class="form-control-feedback"><i class="fas fa-calendar-alt"></i></span>
        </div>
        <div class="form-group">
          <input type="radio" value="female" name="gender" {{ (old('gender') == 'female') ? 'checked' : '' }} >    Female
        </div>
        <div class="form-group">
          <input type="radio" value="male" name="gender" {{ (old('gender') == 'male') ? 'checked' : '' }}>    Male
        </div>
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary  btn-flat" style="">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
	
@endsection

@section('js')
	{{-- here goes js files --}}
@endsection