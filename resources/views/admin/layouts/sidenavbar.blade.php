<!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ (Auth::user()->image) ? Storage::disk('local')->url(Auth::user()->image) : asset('/admin_styles/images/user4-128x128.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <ul class="sidebar-menu">
       <li><a href="{{ route('admin.home') }}"><i class="fa fa-circle text-green"></i> <span>Home</span></a></li>
       <li><a href="{{ route('admin.profile') }}"><i class="fa fa-circle text-red"></i> <span>Profile</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Patients</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.patient.view') }}"><i class="fa fa-circle text-red"></i> View</a></li>
            <li><a href="{{ route('admin.patient.add') }}"><i class="fa fa-circle text-aqua"></i> Add</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-md"></i>
            <span>Nurses</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.nurse.view') }}"><i class="fa fa-circle text-red"></i> View</a></li>
            <li><a href="{{ route('admin.nurse.add') }}"><i class="fa fa-circle text-aqua"></i> Add</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-stethoscope"></i>
            <span>Admins</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.admin.view') }}"><i class="fa fa-circle text-red"></i> View</a></li>
            <li><a href="{{ route('admin.admin.add') }}"><i class="fa fa-circle text-aqua"></i> Add</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-hospital"></i>
            <span>Clinics</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.clinic.view') }}"><i class="fa fa-circle text-red"></i> View</a></li>
            <li><a href="{{ route('admin.clinic.add') }}"><i class="fa fa-circle text-aqua"></i> Add</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-briefcase"></i>
            <span>Workers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.worker.view') }}"><i class="fa fa-circle text-red"></i> View</a></li>
            <li><a href="{{ route('admin.worker.add') }}"><i class="fa fa-circle text-aqua"></i> Add</a></li>
          </ul>
        </li>


        <li class="treeview">
          <a href="#">
            <i class="fa fa-cubes"></i>
            <span>Categories</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.category.view') }}"><i class="fa fa-circle text-red"></i> View</a></li>
            <li><a href="{{ route('admin.category.add') }}"><i class="fa fa-circle text-aqua"></i> Add</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-medkit"></i>
            <span>Materials</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.material.view') }}"><i class="fa fa-circle text-red"></i> View</a></li>
            <li><a href="{{ route('admin.material.add') }}"><i class="fa fa-circle text-aqua"></i> Add</a></li>
          </ul>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
