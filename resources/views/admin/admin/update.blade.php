@extends('admin.layouts.layout')

@section('title')
  {{-- here goes the title of page --}}
  Edit admin
@endsection

@section('css')
  {{-- here goes the css of page --}}
@endsection

@section('body')
  {{-- here goes content of pages --}}
@foreach ($errors->all() as $error)
  <div class="alert alert-danger">{{ $error }}</div>
@endforeach

@if (session('status'))
  <div class="alert alert-success">{{ session('status') }}</div>
@endif
<section class="content">
  <div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">
        <img src="{{ ($admin->image) ? $admin->image : asset(config('app.profile_image')) }}" style="max-width: 50px;" name="userimg" class="img-circle" /> 
        Update admin data
      </h3>
    </div>
    <div class="box-body">
      <form method="post" action="{{ route('admin.admin.update', $admin->id) }}">
        @csrf
        {{ method_field('PATCH') }}
        <div class="form-group has-feedback">
          <input type="text" class="form-control" value="{{ $admin->name }}" placeholder="Full name" name="fullName" required>
          <span class="form-control-feedback"><i class="fa fa-user"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="email" class="form-control" placeholder="Email" value="{{ $admin->email }}" name="email" required>
          <span class="form-control-feedback"><i class="fas fa-envelope"></i></span>
        </div>

         <div class="form-group has-feedback">
          <input type="text" class="form-control" value="{{ $admin->mobile }}" placeholder="Mobile" name="mobile">
          <span class="form-control-feedback"><i class="fas fa-mobile-alt"></i></span>
        </div>

        <div class="form-group">
          <select class="form-control" name="role" required>
            <option value="">Choose Role</option>
            <option value="super" {{ ($admin->role == 'super' ) ? 'selected="selected"' : ''}}>Owner</option>
            <option value="doctor" {{ ($admin->role == 'doctor' ) ? 'selected="selected"' : ''}}>Doctor</option>
          </select>
        </div>
        
        <button class="btn btn-primary">Update</button>
        @if ($admin->status)
          <a href="#" id="updateStatusBtn" class="btn btn-danger btn-md" onclick="
            event.preventDefault();
            if (confirm('Are you sure you want to deactivate this account?')) {
              $('form#updateStatus').submit();
            }
          ">Deactivate Account</a>
        @else
          <a href="#" id="updateStatusBtn" class="btn btn-success btn-md" onclick="
            event.preventDefault();
            if (confirm('Are you sure you want to activate this account?')) {
              $('form#updateStatus').submit();
            }
          ">Activate Account</a>
        @endif
      </form>

      <form action="{{ route('admin.admin.status', $admin->id)}}" method="POST" id="updateStatus">
        @csrf
        {{ method_field('PATCH') }}
      </form>
    </div>
  </div>
</section>
@endsection

@section('js')
  {{-- here goes js files --}}
@endsection