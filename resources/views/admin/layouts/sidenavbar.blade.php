<!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset(Auth::user()->image) }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <ul class="sidebar-menu">
        <li><a href="{{ route('admin.profile') }}"><i class="fa fa-circle text-red"></i> <span>Profile</span></a></li>
        <li><a href="{{ route('admin.patient.add') }}"><i class="fa fa-circle text-yellow"></i> <span>Add Patient</span></a></li>
        <li><a href="{{ route('admin.nurse.add') }}"><i class="fa fa-circle text-yellow"></i> <span>Add Nurse</span></a></li>
        <li><a href="{{ route('admin.admin.add') }}"><i class="fa fa-circle text-yellow"></i> <span>Add Admin</span></a></li>
        <li><a href="{{ route('admin.patient.view') }}"><i class="fa fa-circle text-aqua"></i> <span>Patients</span></a></li>
        <li><a href="#"><i class="fa fa-circle text-aqua"></i> <span>Nurses</span></a></li>
        <li><a href="#"><i class="fa fa-circle text-aqua"></i> <span>Admins</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
