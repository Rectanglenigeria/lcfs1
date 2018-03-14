@extends('layouts.pages')

@section('content')
		



<div role="main" class="main">

	<section class="page-header">
					<div class="container">
						<div class="row">
							<div class="col">
								<ul class="breadcrumb">
									<li><a href="index.html">Home</a></li>
									<li class="active">Testimonies</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<h1>Testimonies</h1>
							</div>
						</div>
					</div>
				</section>

				<div class="container">
				<div class="row">



					@foreach($approvedTestimonies as $testimony)


						<div class="col-lg-6">
							<div class="testimonial testimonial-primary">
								<blockquote>
									<p> {{$testimony->message}}</p>
								</blockquote>
								<div class="testimonial-arrow-down"></div>
								<div class="testimonial-author">
									<div class="testimonial-author-thumbnail img-thumbnail">
										<img src="img/clients/client-1.jpg" alt="">
									</div>
									<p>
										<strong>{{$testimony->user->name}}</strong>
										<span>
											{{date('F d, Y', strtotime($testimony->updated_at))}}&nbsp;|&nbsp;
          {{date('h:i',strtotime($testimony->updated_at))}}
      </span>
									</p>
								</div>
							</div>
						</div>


						 @endforeach



					</div>





					<!--pagination-->

					<div>
						
					{{ $approvedTestimonies->links() }}
						
					</div>
					<!--pagination-->



				</div>

			</div>


@endsection()