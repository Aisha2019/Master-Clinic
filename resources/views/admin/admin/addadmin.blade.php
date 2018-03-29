@extends('admin.layouts.layout')

@section('title')
    Register a new admin
@endsection

@section('css')
  {{-- here goes the css of page --}}
@endsection

@section('body')
  {{-- here goes content of pages --}}

<section class="content">
  <div class="box box-primary">
    <div class="box-body">
      @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
      @endforeach

      <p class="login-box-msg">Register a new admin</p>

      <form  method="post" action="{{ route('admin.admin.add') }}">
        @csrf

        <div class="form-group has-feedback">
          <input type="text" class="form-control" value="{{ old('fullName') }}" placeholder="Full name" name="fullName" required>
          <span class="form-control-feedback"><i class="fa fa-user"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="email" class="form-control" placeholder="Email" value="{{ old('email') }}" name="email" required>
          <span class="form-control-feedback"><i class="fas fa-envelope"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="password" required class="form-control" placeholder="Password" name="password">
          <span class="form-control-feedback"><i class="fa fa-lock"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="password" required class="form-control" name="password_confirmation" placeholder="Confirm password">
          <span class="form-control-feedback"><i class="fa fa-lock"></i></span>
        </div>

         <div class="form-group has-feedback">
          <input type="text" class="form-control" value="{{ old('mobile') }}" placeholder="Mobile" name="mobile">
          <span class="form-control-feedback"><i class="fas fa-mobile-alt"></i></span>
        </div>

        <div class="form-group">
          <select class="form-control" name="role" required>
            <option value="">Choose Role</option>
            <option value="super" {{ (old('role') == 'super' ) ? 'selected="selected"' : ''}}>Owner</option>
            <option value="doctor" {{ (old('role') == 'doctor' ) ? 'selected="selected"' : ''}}>Doctor</option>
          </select>
        </div>

        <button type="submit" class="btn btn-primary  btn-flat" style="">Register</button>
      </form>
    </div>
  </div>
</section>
@endsection

@section('js')
  {{-- here goes js files --}}
@endsection