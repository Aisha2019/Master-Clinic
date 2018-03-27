@extends('admin.layouts.layout')

@section('title')
	{{-- here goes the title of page --}}
	Admins
@endsection

@section('css')
	{{-- here goes the css of page --}}
  	<link rel="stylesheet" href="{{ asset('/admin_styles/css/dataTables.bootstrap.css') }}">

@endsection


@section('body' )
	{{-- here goes content of pages --}}
	@if (session('status'))
		<div class="alert alert-success">{{ session('status') }}</div>
	@endif

	<section class="content-header">
      <h1>
        Admins data
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Admin Data Table</h3>
              <a href="{{ route('admin.admin.add') }}"> <button type="button" class="btn btn-success btn-flat pull-right"> ADD </button> </a>
            </div>
	        <!-- /.box-header -->
	        <div class="box-body">

        			<table id="example1" class="table table-bordered table-striped">
                		<thead>
		                <tr>
		                  <th>ID </th>
		                  <th>Name</th>
		                  <th>Email</th>
		                  <th>Mobile</th>
		                  
		                  <th>Role</th>
		                  <th>Created At</th>
		                  <th>Updated At</th>
		                  <th>Status</th>
		                  <th>Controls</th>
		                </tr>
		                </thead>
		                <tbody>
							@foreach ($admins as $admin)
		                <?php $admin = (object)$admin; ?>
		                  <tr>
		                  	<td>{{ $admin->id }}</td>
		                  	<td>{{ $admin->name }}</td>
		                  	<td>{{ $admin->email }}</td>
		                  	<td>{{ $admin->mobile }}</td>
		                  	
		                  	<td>{{ ($admin->role == 'super' ? 'Owner' : 'Doctor') }}</td>
	                  	<td>{{ $admin->created_at->diffForHumans() }}</td>
	                  	<td>{{ $admin->updated_at->diffForHumans() }}</td>
		                  	<td>
	                  		@if ($admin->status)
	                  			<a href="{{ route('admin.admin.status',$admin->id) }}"><button class="btn btn-success btn-xs " >Active</button></a>
	                  		@else
	                  			<a href="{{ route('admin.admin.status',$admin->id) }}"><button class="btn btn-danger btn-xs" >Inactive</button></a>
	                  		@endif
	                  	</td>
							<td>
								<a href="{{ route('admin.admin.update',$admin->id) }}"><button type="button" class="btn btn-warning btn-xs">Update</button> </a>

								<a href="{{ route('admin.admin.delete',$admin->id) }}"><button type="button" class="btn btn-danger btn-xs">Delete</button> </a>
							</td>
		                  </tr>
		              @endforeach
		                </tbody>
		                <tfoot>
		                <tr>
		                  <th>ID</th>
		                  <th>Name</th>
		                  <th>Email</th>
		                  <th>Mobile</th>
		                  
		                  <th>Role</th>
		                  <th>Created At</th>
		                  <th>Updated At</th>
		                  <th>Status</th>
		                  <th>Controls</th>
		                </tr>
		                </tfoot>
            		</table>
				</div>
			</div>
		</div>
	</div>
</section>	            		



@endsection

@section('js')
	{{-- here goes js files --}}
	<!-- DataTables -->
<script src="{{ asset('/admin_styles/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/admin_styles/js/dataTables.bootstrap.min.js') }}"></script>
<!-- page script -->
<script>
  $(function () {
    
    $('#example1').DataTable({
      	"paging": true,
      	"lengthChange": true,
      	"searching": true,
      	"ordering": true,
      	"info": false,
      	"autoWidth": false
    });
  });
</script>
@endsection