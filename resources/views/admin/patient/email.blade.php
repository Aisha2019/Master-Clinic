@extends('admin.layouts.layout')

@section('title')
		Email patient
@endsection

@section('css')
	{{-- here goes the css of page --}}
  <link rel="stylesheet" href="{{ asset('/admin_styles/css/bootstrap3-wysihtml5.min.css') }}">
@endsection

@section('body')
	{{-- here goes content of pages --}}

<section class="content">
  <div class="box box-primary">
    <div class="box-body">
      @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
      @endforeach

      <h3 class="login-box-msg">Send email to {{ $patient->name }}</h3>

      <form  method="post" action="{{ route('admin.patient.email', $patient->id) }}">
        @csrf
        
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Subject" value="{{ old('subject') }}" name="subject" required autofocus>
          <span class="form-control-feedback"><i class="fas fa-envelope"></i></span>
        </div>

        <textarea name="email" class="textarea" placeholder="Write email here..." style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required>{{ old('email') }}</textarea>

        <button type="submit" class="btn btn-primary btn-flat" style="">Send</button>
      </form>
    </div>
  </div>
</section>
@endsection

@section('js')
	{{-- here goes js files --}}
  <!-- Bootstrap WYSIHTML5 -->
  <script src="{{ asset('/admin_styles/js/bootstrap3-wysihtml5.all.min.js') }}"></script>
  <script>
    $(function () {
      //bootstrap WYSIHTML5 - text editor
      $(".textarea").wysihtml5();
    });
  </script>
@endsection