@extends('user.layouts.layout')

@section('title')
{{-- here goes the title of the page --}}
	Home Page
@endsection

@section('head')
	{{-- this is for the css of this page --}}
@endsection

@section('body')
{{-- here goes the content of the page --}}
	  <div class="card p-3 p-md-5 text-white bg-dark" style="background-image: url({{ asset('/user_styles/images/dental.jpg') }});  no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        height:600px;
        " >
        <div class="container">
        <div class="col-md-6 px-0">
          <h1 class="display-4 font-italic">Title of a longer featured blog post</h1>
          <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what's most interesting in this post's contents.</p>
          <a class="btn btn-lg btn-info" href="#" >Log in</a>
        </div>
        </div>
      </div>


      <div class="container mt-5 mb-5">
      <h1 >
      	<a> About <a/>
        <a style="color: #3ea2b8">us</a>
      </h1>	
       <p>
       	Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown...

        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer.
       </p>
      </div>
      @endsection

@section('footer')
{{-- here goes the js of the page --}}
@endsection