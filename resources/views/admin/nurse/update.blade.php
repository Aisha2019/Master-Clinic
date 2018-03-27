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
$nurse = (object)$nurse;
$img=$nurse->image;;
if($img==NULL)
$img='/user_styles/images/usericon.png';
$image=asset($img);
$nurse_status="Deactivate Account";
if($nurse->status==0)
$nurse_status="Reactivate Account";

?>
  <div class="register-box-body">
    <h1 class="login-box-msg">Nurse Information</h1>


               <img src="{{ $image }}" name="userimg" class="img-circle" />
                <br/>
                <br/>
              <div class="box-body">
                <div class="form-group" >
                  <form method="post" action="{{ route('admin.nurse.update',$nurse->id) }}">
                    @csrf
                    
                  <input type="name" name="id" value="{{ $nurse->id }}" style="display: none;">
                  <label for="inputEmail3" class="col-sm-2 control-label">Full Name</label>
                  <div class="col-sm-5">
                    <input class="form-control"  name="fullName" placeholder="" type="FullName" value="{{ $nurse->name }}">
                  </div>
                </div>
                <br/>
                <br/>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-5">
                    <input class="form-control" placeholder="" name="email" type="email" value="{{ $nurse->email }}">
                  </div>
                </div>
                <br/>
                <br/>
               <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Mobile</label>

               <div class="col-sm-5">
                    <input class="form-control"  placeholder="" name="mobile" type="mobile" value="{{ $nurse->mobile }}">
                  </div>
                </div>
                <br/>
                <br/>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Salary</label>

                  <div class="col-sm-5">
                    <input class="form-control"  placeholder="" name="salary"  value="{{ $nurse->salary }}">
                  </div>
                </div>
                <br/>
                <br/>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Gender</label>

                  <div class="col-sm-5">
                    <input class="form-control"  placeholder="" name="gender"  value="{{ $nurse->gender }}">
                  </div>
                </div>
                <br/>
                <br/>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Birthday</label>

                  <div class="col-sm-5">
                    <input class="form-control"  placeholder="" name="birthday"  value="{{ $nurse->date_of_birth }}">
                  </div>
                </div>
                <br/>
                <br/>
                <div class="form-group">
      
          <select class="form-control" name="clinic" required>
            <option value="@foreach ($clinics as $clinic)
                            <?php $clinic = (object)$clinic; if($clinic->id==$nurse->clinic_id) {break;}?>
                          @endforeach
                          {{ $clinic->name }}">Choose Clinic</option>
              @foreach ($clinics as $clinic)
                <?php $clinic = (object)$clinic; ?>
                  <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
              @endforeach
          </select>
      
  </div>
                
                      <div class="box-footer">
                       <button type="submit" class="btn btn-default btn-md" style="margin-left: 180px">Save</button>
                                             <a href="{{  route('admin.nurse.status', $nurse->id ) }}"  class="btn btn-primary btn-md" style="margin-left: 50px"  >{{ $nurse_status }}<a/>


                      </div>

                  </form>

                </div>
              </div>
            
  </div>

@endsection

@section('js')
  {{-- here goes js files --}}
@endsection