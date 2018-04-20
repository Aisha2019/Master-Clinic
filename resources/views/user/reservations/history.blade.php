@extends('user.layouts.layout')
@section('title')
Reservations
@endsection

@section('css')
  {{-- here goes the css of page --}}
  <link rel="stylesheet" href="{{ asset('/user_styles/css/datepicker3.css') }}">
  <link rel="stylesheet" href="{{ asset('/user_styles/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/user_styles/css/fontawesome-all.min.css') }}">
  <!-- Ionicons -->
@endsection

@section('body')
  {{-- here goes content of pages --}}

<section class="container">
 <div class="box box-primary">
  <div class="box-body">
      @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
      @endforeach
      @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
      @endif

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    <!-- Main content -->
    <section class="content" style="margin-top: 100px; margin-bottom: 500px;">
      <h1 style="margin:20px;text-align:center;">
        Reservation History
      </h1>
      <!-- row -->
<table class="table table-bordered">
  <thead class="thead-dark" >
    <tr>
      <th scope="col">#</th>
      <th scope="col">Doctor</th>
      <th scope="col">Clinic</th>
      <th scope="col">date</th>
      <th scope="col">Time</th>
      <th scope="col">Status</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
      @foreach ($reservations as $k=> $reservation)
    <tr>
      <th scope="row">{{ $k+1 }}</th>
      <td>{{ $reservation['doctor'] }}</td>
      <td>{{ $reservation['clinic'] }}</td>
      <td>{{ $reservation['date'] }}</td>
      <td>{{ $reservation['time'] }}</td>
      @if(!$reservation['nurse'])
      <td> Waiting Confirmation ...  </td>
      @else
      <td>Reservation Confirmed by {{ $reservation['nurse'] }}</td>      
      @endif
      <td> <a class="btn btn-warning btn-xs" href="{{ route('reservations.update',  $reservation['id'] ) }}"><i class="fa fa-edit"></i></a></td>
    </tr>
    @endforeach
  </tbody>
</table>      <!-- /.row -->

      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
</div>
</div>
</section>

@endsection

@section('js')
  {{-- here goes js files --}}
<script src="{{ asset('user_styles/js/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('user_styles/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('user_styles/js/fastclick.js') }}"></script>

@endsection