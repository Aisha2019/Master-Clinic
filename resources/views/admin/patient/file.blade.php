
@extends('admin.layouts.layout')

@section('title')
	Patient File
@endsection

@section('css')
	<link href="https://fonts.googleapis.com/css?family=Economica:400,700&amp;subset=latin-ext" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('/admin_styles/css/file.css') }}">
@endsection

@section('body')
	<div class="container">
		<div class="btn file-button print-button">
			<a class="ml-auto mr-auto" target="_blank" href="{{ route('admin.patient.printfile', $patient->id) }}"><i class="fa fa-print"></i> Print</a>
		</div>
		<div class="btn btn-primary file-button update-button">
			<a class="ml-auto mr-auto" href="{{ route('admin.patient.updatefile', $patient->id) }}"><i class="fa fa-edit"></i> Update</a>
		</div>
	</div>
	<div class="book">
		{{ $num_pages = 0; $num_figues = 0; }}

        @foreach ($pages as $page)
            {{ $prescriptions = $page[0] }}
			{{ $images = $page[1] }}
			{{ $comments = $page[2] }}
			{{ $date = $page[5] }}
			{{ $doctor_name = $page[3] }}
			{{ $doctor_email = $page[4] }}

            <div class='page'>
				<div class='subpage'>
					<header class="head"></header>
					<div class='content'>
            @if ($num_pages == 0) 
            	<h1 style="font-family: Economica', sans-serif; font-weight: bold; font-size: 30pt; margin: 0px; padding: 0px">{{ $patient->name }}</h1>
            @else
                <br><br>
            @endif
            <h2 style="font-family: 'Economica', sans-serif; font-size: 14pt; color: #666666;">Doctor: DR. {{ strtoupper($doctor_name) }}</h2>
			<h2 style="font-family: 'Economica', sans-serif; font-size: 14pt; color: #199ebc">{{ $doctor_email }}</h2>
            <img src="{{ asset('/user_styles/images/bar1.png') }}">
            <h1 style="font-family: 'Open Sans', sans-serif; font-weight: bold; font-size: 16pt;">{{ $date }}</h1>

            {{ $num_pages++ }}
			{{ $num_lines = 25 }}

            @if ($prescriptions != null)
                <h2 style="font-family: 'Open Sans', sans-serif; font-weight: bold;">Prescriptions</h2>
                {{ $prescriptions = $this->string2tags($prescriptions->name) }}

                @foreach($prescriptions as $prescription)
                    @if (strpos($prescription, '<h1>') !== false || strpos($prescription, '<h2>') !== false || strpos($prescription, '<h3>') !== false)
                        @if($num_lines >= 2)
                            {{ $prescription }}
                            {{ $num_lines = $num_lines - 2 }}
                        @else
									</div>
									<footer calss="foot">
										<img src="{{ asset('/user_styles/images/bar2.png') }}">
										<br><br>
										<p>{{ $num_pages }}</p>
									</footer>
								</div>    
							</div>
                            <div class='page'><div class='subpage'><header class="head"></header><div class='content'>
                            <img src="{{ asset('/user_styles/images/bar1.png') }}"><br><br>
                            {{ $prescription }}
                            {{ $num_lines = 29 }}
                            {{ $num_pages++ }}
                        @endif
                    @else
                        @if($num_lines >= 1)
                            {{ $prescription }}
                            {{ $num_lines-- }}
                        @else
									</div>
									<footer calss="foot">
										<img src="{{ asset('/user_styles/images/bar2.png') }}">
										<br><br>
										<p>{{ $num_pages }}</p>
									</footer>
								</div>    
							</div>
                            <div class='page'><div class='subpage'><header class="head"></header><div class='content'>
                            <img src="{{ asset('/user_styles/images/bar1.png') }}"><br><br>
                            {{ $prescription }}
                            {{ $num_lines = 30 }}
                            {{ $num_pages++ }}
                        @endif
                    @endif
                @endforeach
            @endif

            @if ($images != null)
                <h2 style="font-family: 'Open Sans', sans-serif; font-weight: bold;">Images</h2>

                @foreach($images as $image)
                    @if (($image->height + 25) >= 907)
								</div>
								<footer calss="foot">
									<img src="{{ asset('/user_styles/images/bar2.png') }}">
									<br><br>
									<p>{{ $num_pages }}</p>
								</footer>
							</div>    
						</div>
                        <div class='page'><div class='subpage'><header class="head"></header><div class='content'>
                        <img src="{{ asset('/user_styles/images/bar1.png') }}"><br><br>
                        <img src="{{ Storage::disk('local')->url($image->image) }}" class='img-responsive' style='height: 877px; max-width: 100%;'>
                        <p><strong>Figue {{ ++$num_figues }} . ": " . {{ $image->caption }}</strong></p>
								</div>
								<footer calss="foot">
									<img src="{{ asset('/user_styles/images/bar2.png') }}">
									<br><br>
									<p>{{ $num_pages++ }}</p>
								</footer>
							</div>    
						</div>
                        <div class='page'><div class='subpage'><header class="head"></header><div class='content'>
                        <img src="{{ asset('/user_styles/images/bar1.png') }}"><br><br>
                        {{ $num_lines = 31 }}
                        {{ $num_pages++ }}
                    @elseif (($image->height + 25) >= 24 * $num_lines)
								</div>
								<footer calss="foot">
									<img src="{{ asset('/user_styles/images/bar2.png') }}">
									<br><br>
									<p>{{ $num_pages++ }}</p>
								</footer>
							</div>    
						</div>
                        <div class='page'><div class='subpage'><header class="head"></header><div class='content'>
                        <img src="{{ asset('/user_styles/images/bar1.png') }}"><br><br>
                        <img src="{{ Storage::disk('local')->url($image->image) }}" class='img-responsive' style='max-width: 100%;'>
                        <p><strong>Figue {{ ++$num_figues }} . ": " . {{ $image->caption }}</strong></p>

                        {{ $num_lines = 31 - ceil(($image->height + 25) / 24.0) }}
                        {{$num_pages++}}
                    }
                    @else
                        <img src="{{ Storage::disk('local')->url($image->image) }}" class='img-responsive' style='max-width: 100%;' >
                        <p><strong>Figue{{ ++$num_figues }} . ": " . {{ $image->caption }}</strong></p>";

                        {{ $num_lines = $num_lines - ceil(($image->height + 25) / 24.0) }}
                    @endif
                @endif
            @endforeach
            
            @if ($comments != null)
                <h2 style="font-family: 'Open Sans', sans-serif; font-weight: bold;">Comments</h2>
                {{ $comments = $this->string2tags($comments->name) }}

                @foreach($comments as $comment)
                    @if (strpos($comment, '<h1>') !== false || strpos($comment, '<h2>') !== false || strpos($comment, '<h3>') !== false)
                        @if($num_lines >= 2)
                            {{ $comment }}
                            {{ $num_lines = $num_lines - 2 }}
                        @else
									</div>
									<footer calss="foot">
										<img src="{{ asset('/user_styles/images/bar2.png') }}">
										<br><br>
										<p>{{ $num_pages++ }}</p>
									</footer>
								</div>    
							</div>
                            <div class='page'><div class='subpage'><header class="head"></header><div class='content'>
                            <img src="{{ asset('/user_styles/images/bar1.png') }}"><br><br>
                            {{ $comment }}
                            {{ $num_lines = 29 }}
                            {{ $num_pages++ }}
                        @endif
                    @else
                        @if($num_lines >= 1)
                            {{ $comment }}
                            {{ $num_lines-- }}
                        @else
									</div>
									<footer calss="foot">
										<img src="{{ asset('/user_styles/images/bar2.png') }}">
										<br><br>
										<p>{{ $num_pages++ }}</p>
									</footer>
								</div>    
							</div>
                            <div class='page'><div class='subpage'><header class="head"></header><div class='content'>
                            <img src="{{ asset('/user_styles/images/bar1.png') }}"><br><br>
                            {{ $comment }}
                            {{ $num_lines = 30 }}
                            {{ $num_pages++ }}
                        @endif
                    @endif
                @endforeach
            @endif
        @endforeach
	</div>
@endsection

@section('js')
	<script>
		$(function(){
			console.log($('p').height());
		});
	</script>
@endsection