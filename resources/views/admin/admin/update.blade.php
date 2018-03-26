@extends('admin.layouts.layout')

@section('title')
  {{-- here goes the title of page --}}
      Update
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
          <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
  @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif
<?php
$admin = (object)$admin;
$img=$admin->image;;
if($img==NULL)
$img='/user_styles/images/usericon.png';
$image=asset($img);
$admin_status="Deactivate Account";
if($admin->status==0)
$admin_status="Reactivate Account";

?>
  <div class="register-box-body">
    <h1 class="login-box-msg">Admin Information</h1>

               <img src="{{ $image }}" name="userimg" class="img-circle" />
                <br/>
                <br/>
              <div class="box-body">
                <div class="form-group" >
                  <form method="post" action="{{ route('admin.admin.view') }}">
                    @csrf
                    
                  <input type="name" name="id" value="{{ $admin->id }}" style="display: none;">
                  <label for="inputEmail3" class="col-sm-2 control-label">Full Name</label>
                  <div class="col-sm-5">
                    <input class="form-control"  name="fullName" placeholder="" type="FullName" value="{{ $admin->name }}">
                  </div>
                </div>
                <br/>
                <br/>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-5">
                    <input class="form-control" placeholder="" name="email" type="email" value="{{ $admin->email }}">
                  </div>
                </div>
                <br/>
                <br/>
               <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Mobile</label>

               <div class="col-sm-5">
                    <input class="form-control"  placeholder="" name="mobile" type="mobile" value="{{ $admin->mobile }}">
                  </div>
                </div>
                <br/>
                <br/>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Gender</label>

                  <div class="col-sm-5">
                    <input class="form-control"  placeholder="" name="gender" type="gender" value="{{ $admin->gender }}">
                  </div>
                </div>
                <br/>
                <br/>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Role</label>

                  <div class="col-sm-5">
                    <input class="form-control"  placeholder="" name="role" type="role" value="{{ $admin->role }}">
                  </div>
                </div>
                <br/>
                <br/>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Date of birth</label>
                  <div class="col-sm-5">
                    <input class="form-control"  placeholder="" name="birthday" type="date" value="{{ $admin->date_of_birth }}">
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