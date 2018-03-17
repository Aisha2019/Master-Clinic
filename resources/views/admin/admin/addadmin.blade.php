@extends('admin.layouts.layout')

@section('title')

    Register a new Admin
@endsection

@section('css')
  {{-- here goes the css of page --}}
@endsection

@section('body')
  {{-- here goes content of pages --}}

  <div class="register-box-body">
    <p class="login-box-msg">Add a new Admin</p>

    <form action="addadmin" method="post">
      @csrf
          <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Full name" name="name">
        <span class="form-control-feedback"><i class="fa fa-user"></i></span>
        <br/>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email">
        <span class="form-control-feedback"><i class="fas fa-envelope"></i></span>
                <br/>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="form-control-feedback"><i class="fa fa-lock"></i></span>
              <br/>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Confirm password" name="confirmpassword">
        <span class="form-control-feedback"></span>
              <br/>
      </div>
       <div class="form-group has-feedback">
        <input type="Mobile" class="form-control" placeholder="Mobile"  name="mobile">
        <span class="form-control-feedback"><i class="fas fa-mobile-alt"></i></span>
              <br/>
      </div>
        <div class="form-group has-feedback">
        <input type="date" class="form-control" placeholder=" Birthday" name="date">
        <span class="form-control-feedback"><i class="fas fa-calendar-alt"></i></span>
              <br/>
        </div>
        <br/>
      <div>
  <input type="radio" name="role" >    Admin
  <br/>
  <input type="radio" name="role" >    Super Admin
              <br/>
      </div>
      <br/>
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary  btn-flat" style="">Add Admin</button>
        </div>
        <!-- /.col -->
      </div>
    </form>


  </div>
  <!-- /.form-box -->
<!-- /.register-box -->

<!-- jQuery 2.2.3 -->

  
@endsection

@section('js')
  {{-- here goes js files --}}
@endsection