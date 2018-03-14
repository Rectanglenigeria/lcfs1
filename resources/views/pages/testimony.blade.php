@extends('layouts.pages');

@section('content')
		<!-- Google maps element -->
		<div class="hidden-sm hidden-xs">
      
    <br><br>
    </div>
    <!--/ G
      
		<!--/ Google maps element -->

		<!-- Contact form & details section -->
		<section class="hg_section ptop-80 pbottom-80">
			<div class="container">
				<div class="row">
				<ol class="breadcrumb">
  <li><a href="{{URL::to('/register')}}">Home</a></li>
  <li><a href="{{URL::to('/testimonial')}}">Testimonies</a></li>
</ol>

  <!--testimonials-->


  	
            <div class="col-md-12">

            
            <div class="thumbnail">
         @if($testimony->has_video != null && $testimony->has_video != '0')

<?php

     $rawLink=$testimony->video_link;
     $explodedLink=explode('watch?v=', $rawLink);
     $implodedLink=implode('embed/', $explodedLink);
?>
   

          <iframe style="width:100%;height: 450px" src="{{$implodedLink}}" frameborder="0" allowfullscreen></iframe>



       <!--<video controls poster="" width="350">
          <source src="{{$testimony->video_link}}" type="video/mp4">
            Your browser does not support HTML5 video.
    </video>-->
        @else

        <img src="{{asset('public/videos/placeholderImage.png')}}" style="width:100%;height: 450px">

        @endif


      <div class="caption">
        <span style="float:left;">
          {{date('F d, Y', strtotime($testimony->updated_at))}}&nbsp;|&nbsp;
          {{date('h:i',strtotime($testimony->updated_at))}}
        </span>
        <hr>
        <h3>{{$testimony->user->name}}</h3>
        <p style="line-height: 40px;">{{$testimony->message}}</p>
        <p><a href="{{URL::to('/testimonial')}}" class="btn btn-danger btn-sm" role="button">Back</a> </p>
      </div>
    </div>
    </div>

  

		  <!--testimonials-->


					<!--/ col-md-9 col-sm-9 -->

				</div>

			
				<!--/ .row -->
			</div>
			<!--/ .container -->
		</section>
		<!--/ Contact form & details section -->

     @endsection()