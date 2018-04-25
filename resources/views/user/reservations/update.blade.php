@extends('user.layouts.layout')
@section('title')
Reservations
@endsection

@section('css')
  {{-- here goes the css of page --}}
  <link rel="stylesheet" href="{{ asset('/nurse_styles/css/datepicker3.css') }}">
  <link rel="stylesheet" href="{{ asset('/user_styles/css/bootstrap-timepicker.min.css') }}">
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
 <p class="login-box-msg h3" style="text-align:center; margin:70px; margin-top:100px ">Make a Reservation</p>
        @foreach ($reservations as  $reservation)
  <form  method="post" action="{{ route('reservations.update',$reservation['id']) }}">
  @csrf
   {{ method_field('PATCH') }}


<div class="form-row">
   <div class="input-group-prepend col-md-6">

    <label class="text" for="inputGroupSelect01">Doctor</label>
  </div>
   <div class="input-group-prepend col-md-6">
    <label class="text" for="inputGroupSelect01">Clinic</label>

</div>
</div>


<div class="form-row">
   <div class="input-group-prepend col-md-6">

    <input class="form-control" id="disabledInput" type="text" placeholder="{{ $reservation['doctor'] }}" disabled  >
  </div>
   <div class="input-group-prepend col-md-6">
    <input class="form-control" id="disabledInput" type="text" placeholder="{{ $reservation['clinic'] }}" disabled>

</div>
</div>

<br/>
<br/>
<div class="form-row">
   <div class="input-group-prepend col-md-6">
  <select class="custom-select" id="inputGroupSelect01" name="admin" >
    <option selected >Change Doctor</option>
             @foreach ($admins as $admin)
                  <option value="{{ $admin->id }}" {{
                   (old('admin') == $admin->id ) ? 'selected="selected"' : ''}}>{{ $admin->name }}</option>
             @endforeach
  </select>
</div>
   <div class="input-group-prepend col-md-6">
    <select class="custom-select" id="inputGroupSelect01" name="clinic" >
    <option selected>Change Clinic</option>

              @foreach ($clinics as $clinic)
                  <option value="{{ $clinic->id }}" {{ (old('clinic') == $clinic->id ) ? 'selected="selected"' : ''}}>{{ $clinic->name }}</option>
              @endforeach
  </select>
</div>
</div>
  <br/>  
  <br/>

    <div class="input-group date datepicker" data-date-format="dd-mm-yyyy" data-provide="datepicker" id="datepicker"  >
    <input type="text" class="form-control" value="{{ $reservation['date'] }}" name="date">
     <div class="input-group-addon">
        <span class="glyphicon glyphicon-th"></span>
      </div>
</div>

       <br/>
              <div class="bootstrap-timepicker">
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control timepicker" id="timepicker" name="time" placeholder="" value="{{ $reservation['time'] }}">
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
       <br/>
      <button type="submit" class="btn btn-info  btn-flat" style="margin-bottom: 20px">Update</button>
       </form>
        <button type="submit" class="btn btn-info  btn-flat" style="margin-bottom: 20px" onclick="
        event.preventDefault();
        if(confirm('Are you sure you want to delete this reservation?')) {
          $(this).siblings('form').submit();
        }">Delete</button>
      <form action="{{ route('user.reservation.delete',$reservation['id']) }}" method="POST">
            @csrf
            {{ method_field('DELETE') }}
        </form>
@endforeach
 
</div>
</div>
</section>

@endsection

@section('js')
  {{-- here goes js files --}}
  <script src="{{ asset('/nurse_styles/js/bootstrap-datepicker.js') }}"></script>
  <script src="{{ asset('/user_styles/js/bootstrap-timepicker.min.js') }}"></script>
    <script >
      $('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    startDate: '1d',
     autoclose: true,
     });

    </script>
    <script>
    $(function(){
    $("#timepicker").timepicker({
      autoclose: true,
      format: 'H:i A',
    });
  });

  </script>

@endsection