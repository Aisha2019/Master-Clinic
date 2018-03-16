@extends('nurse.layouts.layout')

@section('title')
	{{-- here goes the title of page --}}
	Add Patient
@endsection

@section('css')
	{{-- here goes the css of page --}}

@endsection

@section('body')
	{{-- here goes content of pages --}}
<div class="register-box-body">
    <p class="login-box-msg">Register a new patient</p>

    <form  method="post">
    	@csrf
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Full name" name="fullName">
        <span class="form-control-feedback"><i class="fa fa-user"></i></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email">
        <span class="form-control-feedback"><i class="fas fa-envelope"></i></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="form-control-feedback"><i class="fa fa-lock"></i></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Confirm password">
        <span class="form-control-feedback"></span>
      </div>
       <div class="form-group has-feedback">
        <input type="Mobile" class="form-control" placeholder="Mobile" name="mobile">
        <span class="form-control-feedback"><i class="fas fa-mobile-alt"></i></span>
      </div>
        <div class="form-group has-feedback">
        <input type="date" class="form-control" placeholder=" Birthday" name="birthday">
        <span class="form-control-feedback"><i class="fas fa-calendar-alt"></i></span>
        </div>
      <div>
  <input type="radio" name="gender" >    Female
  <br/>
  <input type="radio" name="gender" >    Male
      </div>
      <br/>
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary  btn-flat" style="">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>


  </div>
  <!-- /.form-box -->
<!-- /.register-box -->

	
@endsection

@section('js')
	{{-- here goes js files --}}
@endsection
