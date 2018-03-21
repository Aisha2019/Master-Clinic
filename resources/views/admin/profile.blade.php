@extends('admin.layouts.layout')

@section('title')
	{{-- here goes the title of page --}}
	Admin profile
@endsection

@section('css')
	{{-- here goes the css of page --}}
@endsection

@section('body')
	
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                  
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset(Auth::user()->image) }}" alt="User profile picture">
                    <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                    <p class="text-muted text-center">{{ Auth::user()->role }}</p>
                    
                    <form action="{{ route('admin.update.profile_picture') }}" class="update-profile-picture" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" id="file" style="display: none" onchange="$('.update-profile-picture').submit();" name="picture" />
                        <label for="file" class="btn btn-primary btn-block">Change Profile Picture</label>
                    </form>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Email</b> <a class="pull-right">{{ Auth::user()->email }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Mobile</b> <a class="pull-right">{{ Auth::user()->mobile }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Number Of Patients</b> <a class="pull-right">13,287</a>
                        </li>
                    </ul>

                  </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">About Me</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

                    <p class="text-muted">B.S. in Computer Science from the University of Tennessee at Knoxville</p>

                    <hr>

                    <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                    <p class="text-muted">Malibu, California</p>

                    <hr>

                    <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

                    <p>
                        <span class="label label-danger">UI Design</span>
                        <span class="label label-success">Coding</span>
                        <span class="label label-info">Javascript</span>
                        <span class="label label-warning">PHP</span>
                        <span class="label label-primary">Node.js</span>
                    </p>

                    <hr>

                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#updateData" data-toggle="tab">Update Info</a></li>
                    <li><a href="#resetPassword" data-toggle="tab">Reset Password</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="updateData">
                        <form class="form-horizontal" action="#">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Full Name</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName" name="name" placeholder="Full Name" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" value="{{ Auth::user()->email }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputMobile" class="col-sm-2 control-label">Mobile</label>

                                    <div class="col-sm-10">
                                        <input type="Mobile" class="form-control" id="inputMobile" name="mobile" placeholder="Mobile" value="{{ Auth::user()->mobile }}">
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <input type="reset" class="btn btn-default" value="Cancel" />
                                <button type="submit" class="btn btn-primary pull-right">Update</button>
                            </div>
                        <!-- /.box-footer -->
                        </form>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="resetPassword">
                        <form class="form-horizontal" action="#">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputOldPassword" class="col-sm-2 control-label">Old Password</label>

                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputOldPassword" name="oldPassword" placeholder="Old Name" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputNewPassword" class="col-sm-2 control-label">New Password</label>

                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputNewPassword" name="newPassword" placeholder="New Password" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputNewPasswordConfirm" class="col-sm-2 control-label">Confirm New Password</label>

                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputNewPasswordConfirm" name="newPasswordConfirm" placeholder="Confirm New Password" required>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary pull-right">Update Password</button>
                            </div>
                        <!-- /.box-footer -->
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

</section>
@endsection

@section('js')
	{{-- here goes js files --}}
@endsection