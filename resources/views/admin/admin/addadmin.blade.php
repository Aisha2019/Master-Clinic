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

    <form action="../../index.html" method="post">
      @csrf
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Full name">
        <span class="form-control-feedback"><i class="fa fa-user"></i></span>
        <br/>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email">
        <span class="form-control-feedback"><i class="fas fa-envelope"></i></span>
                <br/>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password">
        <span class="form-control-feedback"><i class="fa fa-lock"></i></span>
              <br/>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Confirm password">
        <span class="form-control-feedback"></span>
              <br/>
      </div>
       <div class="form-group has-feedback">
        <input type="Mobile" class="form-control" placeholder="Mobile" >
        <span class="form-control-feedback"><i class="fas fa-mobile-alt"></i></span>
              <br/>
      </div>
        <div class="form-group has-feedback">
        <input type="date" class="form-control" placeholder="Admin added at">
        <span class="form-control-feedback"><i class="fas fa-calendar-alt"></i></span>
              <br/>
        </div>
      <div>
  <input type="radio" name="gender" >    Admin
  <br/>
  <input type="radio" name="gender" >    Super Admin
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