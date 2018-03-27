@extends('nurse.layouts.layout')

@section('title')
	{{-- here goes the title of page --}}
	Patients
@endsection

@section('css')
	{{-- here goes the css of page --}}
	<!-- DataTables -->
	<link rel="stylesheet" href="{{ asset('/admin_styles/css/dataTables.bootstrap.css') }}">


@endsection


@section('body' )
	{{-- here goes content of pages --}}
	@if (session('status'))
		<div class="alert alert-success">{{ session('status') }}</div>
	@endif

	        		
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Patient Data Table</h3>
              <a href="{{ route('nurse.patient.add') }}"> <button type="button" class="btn btn-success btn-flat pull-right"> ADD </button> </a>
            </div>
	        <!-- /.box-header -->
	        <div class="box-body">

	        	<table id="example1" class="table table-bordered table-striped">
	                <thead>
		                <tr>
		                  <th>ID</th>
		                  <th>Name</th>
		                  <th>Email</th>
		                  <th>Mobile</th>
		                  <th>Gender</th>
		                  <th>Birthday</th>
		                  <th>Status</th>
		                  <th>Controls</th>
		                </tr>
		                </thead>
		                <tbody>
							@foreach ($patients as $patient)
		                <?php $patient = (object)$patient; ?>
		                  <tr>
		                  	<td>{{ $patient->id }}</td>
		                  	<td>{{ $patient->name }}</td>
		                  	<td>{{ $patient->email }}</td>
		                  	<td>{{ $patient->mobile }}</td>
		                  	<td>{{ ucfirst($patient->gender) }}</td>
		                  	<td>{{ $patient->date_of_birth }}</td>
		                  	<td>
								@if ($patient->status)
		                  			<a href="#"><button class="btn btn-success btn-xs " >Active</button></a>
		                  		@else
		                  			<a href="#"><button class="btn btn-danger btn-xs" >Inactive</button></a>
		                  		@endif
		                  	</td>
							<td>
								<a href="{{ route('nurse.patient.updatepatient',  $patient->id ) }}"  class="btn btn-block btn-warning btn-xs">Update</a>

								<a href="{{ route('nurse.patient.table.delete',$patient->id) }}" class="btn btn-block btn-danger btn-xs">Delete</a> 
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
		                  <th>Gender</th>
		                  <th>Birthday</th>
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
      	"autoWidth": false,
    });
  });
</script>
@endsection