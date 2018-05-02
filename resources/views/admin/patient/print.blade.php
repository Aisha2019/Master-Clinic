<!DOCKTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link href="https://fonts.googleapis.com/css?family=Economica:400,700&amp;subset=latin-ext" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
        <link rel="shortcut icon" href="{{ asset('/user_styles/images/testlogo.png') }}" />
        <!-- CSS -->
        <link rel="shortcut icon" href="{{ asset('/user_styles/images/testlogo.png') }}" />
        <link rel="stylesheet" href="{{ asset('/user_styles/css/file.css') }}">

		<title>Print</title>
	</head>

	<body>
		<div class="book">
    		<div class="page">
    		    <div class="subpage">
					<header class="head">

					</header>

					<div class="content">
						<h1 style="font-family: 'Economica', sans-serif; font-weight: bold; font-size: 30pt; margin: 0px; padding: 0px">Abdelrahman Mohamed</h1>
						<h2 style="font-family: 'Economica', sans-serif; font-size: 14pt; color: #666666;">Doctor: DR. WENDY WRITER</h2>
						<h2 style="font-family: 'Economica', sans-serif; font-size: 14pt; color: #199ebc">doctor_email@example.com</h2>
						<img src="{{ asset('/user_styles/images/bar1.png') }}">
						<br>
						<h1 style="font-family: 'Open Sans', sans-serif; font-weight: bold; font-size: 16pt;">04 September 20XX</h1>
						<br>
						<h2 style="font-family: 'Open Sans', sans-serif; font-weight: bold; font-size: 13pt;">Prescription</h2>
						<h2 style="font-family: 'Open Sans', sans-serif; font-weight: bold; font-size: 13pt;">Photos</h2>
						<h2 style="font-family: 'Open Sans', sans-serif; font-weight: bold; font-size: 13pt;">Notess</h2>
					</div>

					<footer class="foot">
						<img src="{{ asset('/user_styles/images/bar2.png') }}">
						<br><br>
						<p>1</p>
					</footer>
				</div>    
			</div>
			
    		<div class="page">
				<div class="subpage">
					<header class="head">

					</header>

					<div class="content">
						<h1 style="font-family: 'Economica', sans-serif; font-weight: bold; font-size: 30pt; margin: 0px; padding: 0px">Abdelrahman Mohamed</h1>
						<br>
						<h2 style="font-family: 'Economica', sans-serif; font-size: 14pt; color: #666666;">Doctor: DR. WENDY WRITER</h2>
						<h2 style="font-family: 'Economica', sans-serif; font-size: 14pt; color: #199ebc">doctor_email@example.com</h2>
						<img src="{{ asset('/user_styles/images/bar1.png') }}">
						<br><br>
						<h1 style="font-family: 'Open Sans', sans-serif; font-weight: bold; font-size: 16pt;">04 September 20XX</h1>
						<br>
						<h2 style="font-family: 'Open Sans', sans-serif; font-weight: bold; font-size: 13pt;">Prescription</h2>
						<h2 style="font-family: 'Open Sans', sans-serif; font-weight: bold; font-size: 13pt;">Photos</h2>
						<h2 style="font-family: 'Open Sans', sans-serif; font-weight: bold; font-size: 13pt;">Notess</h2>
					</div>

					<footer class="foot">
						<img src="{{ asset('/user_styles/images/bar2.png') }}">
						<br><br>
						<p>1</p>
					</footer>
				</div>      
    		</div>
		</div>

        <script src="{{ asset('/user_styles/js/jquery.min.js') }}"></script>
        <script>
			$(function(){
				window.print();
				window.close();
			});
		</script>
	</body>
</html>