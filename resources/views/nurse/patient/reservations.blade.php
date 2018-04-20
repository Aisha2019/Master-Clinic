@extends('nurse.layouts.layout')

@section('title')
  {{-- here goes the title of page --}}
  Reservations
@endsection

@section('css')
  {{-- here goes the css of page --}}
   <link rel="stylesheet" href="{{ asset('/nurse_styles/css/datepicker3.css') }}">
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
    <!-- Content Header (Page header) -->
  <form method="post" action="{{ route('nurse.reservations') }}">
    @csrf
        <div class="form-group has-feedback " style="margin: 20px">
          <input type="text" id="datepicker" class="form-control " placeholder=" Reservation Date" value="{{ old('Reservationdate') }}" name="Reservationdate" >
          <span class="form-control-feedback" ><i class="fas fa-calendar-alt"></i></span>
        </div>
        <br/>
      <button type="submit" class="btn btn-info  btn-flat" style="margin-left: 20px;margin-bottom: 20px;">Search</button> 
 </form>
    <section class="content-header">
      <h1>
        Timeline
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- row -->
      <div class="row">

        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            @foreach ($reservations as $reservation)
            <li class="time-label">
                  <span class="bg-red">
                   {{ $reservation['date'] }}
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-user bg-aqua"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i>
                   {{ $reservation['time'] }}
                   </span>

                <h3 class="timeline-header"><a href="#">{{ $reservation['patient'] }}</a></h3>

                <div class="timeline-body">
                  Doctor : {{ $reservation['doctor'] }}
                  <br/>
                  Clinic : {{ $reservation['clinic'] }}
                  <br/>
                  Nurse  : {{ $reservation['nurse'] }}
                </div>
                <div class="timeline-footer">
                  @if(!$reservation['nurse'])
                  <a class="btn btn-info btn-xs" href="{{ route('reservations.confirm',$reservation['id']) }}">Confirm</a>

                  <a class="btn btn-info btn-xs" onclick="
                                  event.preventDefault();
                                  if(confirm('Are you sure you want to reject this reservation?')) {
                                    $(this).siblings('form').submit();
                                  }">Reject</a>
                  <form action="{{ route('reservation.delete',$reservation['id']) }}" method="POST">
                        @csrf
                        {{ method_field('DELETE') }}
                    </form>
                  @endif
                </div>
              </div>
            </li>
            @endforeach
            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
          </ul>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
</section>

@endsection

@section('js')

  <script src="{{ asset('/nurse_styles/js/bootstrap-datepicker.js') }}"></script>
<script>
   $(function() {
    //Date picker
      $('#datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
      });
    });
  </script>

@endsection