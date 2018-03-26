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
	@if (session('status'))
		<div class="alert alert-success">{{ session('status') }}</div>
	@endif
  <div class="register-box-body">

    <h1 class="login-box-msg">Update admin data</h1>

    <img src="{{ asset('/user_styles/images/usericon.png') }} " name="userimg" class="img-circle" />
    <br/>
    <br/>

    <div class="box-body">
      <div class="form-group" >
        <label for="inputEmail3" class="col-sm-2 control-label">Full Name</label>
        <div class="col-sm-5">
          <input class="form-control"  placeholder="" type="email">
        </div>
      </div>
      <br/>
      <br/>
      <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Email</label>

        <div class="col-sm-5">
          <input class="form-control" placeholder="" type="password">
        </div>
      </div>
      <br/>
      <br/>
     <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Mobile</label>

     <div class="col-sm-5">
          <input class="form-control"  placeholder="" type="password">
        </div>
      </div>
      <br/>
      <br/>

      <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Gender</label>

        <div class="col-sm-5">
          <input class="form-control"  placeholder="" type="password">
        </div>
      </div>
      <br/>
      <br/>
      <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Date of birth</label>

        <div class="col-sm-5">
          <input class="form-control"  placeholder="" type="password">
        </div>
      </div>

    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <button type="submit" class="btn btn-default btn-md" style="margin-left: 190px">Save</button>
      <button type="submit" class="btn btn-info pull-right " style="align-self: center;">Deactivate Account</button>
    </div>
    <!-- /.box-footer -->
            
  </div>




	
@endsection

@section('js')
	{{-- here goes js files --}}
@endsection