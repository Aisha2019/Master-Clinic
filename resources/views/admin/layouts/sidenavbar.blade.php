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
        <li><a href="#"><i class="fa fa-circle text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle text-aqua"></i> <span>Information</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
