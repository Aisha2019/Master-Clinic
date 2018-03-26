@extends('admin.layouts.layout')

@section('title')
	{{-- here goes the title of page --}}
	Patients
@endsection

@section('css')
	{{-- here goes the css of page --}}
	<!-- DataTables -->
  <link rel="stylesheet" href="/css/dataTables.bootstrap.css">
  <link rel="stylesheet" href="/css/jquery.dataTables.css">
  <link rel="stylesheet" href="/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="/css/jquery.dataTables_themeroller.css">


@endsection


@section('body' )
	{{-- here goes content of pages --}}
	@if (session('status'))
		<div class="alert alert-success">{{ session('status') }}</div>
	@endif

	        			<table id="example1" class="table table-bordered table-striped">
	                		<thead>
			                <tr>
			                  <th>Name<i class="fas fa-sort fa-xs"></i></th>
			                  <th>Email<i class="fas fa-sort fa-xs"></i></th>
			                  <th>Mobile<i class="fas fa-sort fa-xs"></i></th>
			                  <th>Gender<i class="fas fa-sort fa-xs"></i></th>
			                  <th>Birthday<i class="fas fa-sort fa-xs"></i></th>
			                  <th>Status<i class="fas fa-sort fa-xs"></i></th>
			                  <th> <a href="{{ route('admin.patient.add') }}"> <button type="button" class="btn btn-block btn-success btn-xs"> ADD </button> </a></th>
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
			                  	<td>{{ $patient->gender }}</td>
			                  	<td>{{ $patient->date_of_birth }}</td>
			                  	<td>{{ $patient->status }}</td>
								<td>
								<a href="{{ route('admin.patient.update', ['patientid', $patient->id] ) }}"  class="btn btn-block btn-warning btn-xs">Update</a>

								<a href="{{ route('admin.patient.table.delete',$patient->id) }}" class="btn btn-block btn-danger btn-xs">Delete</a> 
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
			                </tr>
			                </tfoot>
	            		</table>
	            		


@endsection

@section('js')
	{{-- here goes js files --}}
	<!-- DataTables -->
<script src="/js/jquery.dataTables.min.js"></script>
<script src="/js/jquery.dataTables.js"></script>
<script src="/js/dataTables.bootstrap.min.js"></script>
<script src="/js/dataTables.bootstrap.js"></script>
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