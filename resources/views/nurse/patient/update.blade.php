@extends('nurse.layouts.layout')

@section('title')
	{{-- here goes the title of page --}}
	
@endsection

@section('css')
	{{-- here goes the css of page --}}
	<style >
		  <link rel="stylesheet" href="{{ asset('/user_styles/css/datepicker3.css') }}">

	</style>
@endsection

@section('body')
	{{-- here goes content of pages --}}
      @foreach ($errors->all() as $error)
      <div class="card-header bg-danger text-white mb-3"><i class="fa fa-times fa-lg"></i> {{ $error }}</div>
        @endforeach

 @if (session('status'))
<div class="pt-3 pb-3">
      <div class="card-header bg-success text-white mb-3"><i class="fa fa-check fa-lg"></i> {{ session('status') }}</div>
    </div>
      @endif
<?php
$img=$patient->image;;
if($img==NULL)
$img='/user_styles/images/usericon.png';
$image=asset($img);
?>
  <div class="register-box-body">
    <h1 class="login-box-msg">User Information</h1>

               <img src="{{ $image }}" name="userimg" class="img-circle" />
                <br/>
                <br/>
              <div class="box-body">
                <div class="form-group" >
                  <form method="post" action="{{ route('nurse.patient.update') }}">
                    @csrf
                    
                  <input type="name" name="id" value="{{ $patient->id }}" style="display: none;">
                  <label for="inputEmail3" class="col-sm-2 control-label">Full Name</label>
                  <div class="col-sm-5">
                    <input class="form-control"  name="fullName" placeholder="" type="FullName" value="{{ $patient->name }}">
                  </div>
                </div>
                <br/>
                <br/>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-5">
                    <input class="form-control" placeholder="" name="email" type="email" value="{{ $patient->email }}">
                  </div>
                </div>
                <br/>
                <br/>
               <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Mobile</label>

               <div class="col-sm-5">
                    <input class="form-control"  placeholder="" name="mobile" type="mobile" value="{{ $patient->mobile }}">
                  </div>
                </div>
                <br/>
                <br/>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Gender</label>

                  <div class="col-sm-5">
                    <input class="form-control"  placeholder="" name="gender" type="gender" value="{{ $patient->gender }}">
                  </div>
                </div>
                <br/>
                <br/>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Date of birth</label>
                  <div class="col-sm-5">
                    <input class="form-control"  placeholder="" name="birthday" type="date" value="{{ $patient->date_of_birth }}">
                  </div>
                  <br/>
                <br/>
                      <div class="box-footer">
                       <button type="submit" class="btn btn-default btn-md" style="margin-left: 180px">Save</button>
                      </div>

                  </form>
                </div>
              </div>
            
  </div>

@endsection

@section('js')
	{{-- here goes js files --}}
@endsection