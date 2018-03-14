@extends('admin.layouts.main')

@section('content')


<div id="main">
<div class="container-fluid">
<div class="page-header">
	<div class="pull-left">
		<h1>Match users</h1>
	</div>
	<div class="pull-right">
		
		<ul class="stats">
			
							<li class='lightred'>
								<i class="fa fa-calendar"></i>
								<div class="details">
									<span class="big">
										<?php  echo date('M d, Y'); ?>
									</span>
									<span><?php echo date('D, h:i a')?></span>
								</div>
							</li>

		</ul>
	</div>
</div>
<div class="breadcrumbs">
	<ul>
		<li>
			<a href="more-login.html">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="tables-basic.html">Match users</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
	<div class="close-bread">
		<a href="#">
			<i class="fa fa-times"></i>
		</a>
	</div>
</div>





				<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-th-list"></i>Help available</h3>
							</div>
							<div class="box-content nopadding">
								<form action="{{url('admin/matchlist/match')}}" method="POST" class='form-horizontal form-bordered' enctype='multipart/form-data'>
								
								<input type="hidden" name="_token" value="{{csrf_token()}}" />

								<input type="hidden" name="ghuser_id"  value="{{$ghuserId}}">

								<input type="hidden" name="gh_id"  value="{{$ghId}}">

								<input type="hidden" name="gh_amount"  value="{{$ghAmount}}">
            
									<div class="form-group">
										<label for="textfield" class="control-label col-sm-2">Pick someone here</label>
										<div class="col-sm-10">
											<select name="ph_param" id="select" class='chosen-select form-control'>

											<option selected="selected" disabled="disabled">Pick someone</option>

									@foreach($helprequests as $helprequest)
									  <?php
									  	if($helprequest->user->id==$ghuserId){
									  		continue;
									  	}

									  	if($helprequest->user->status=='1'){
									  		continue;
									  	}
									  ?>
												<option value="{{$helprequest->user->id.'/'.$helprequest->id.'/'.$helprequest->amount}}">
												{{$helprequest->user->username}}
												(&nbsp;
												{{$helprequest->amount}})
												
												</option>

								     @endforeach
												
											</select>
										</div>
									</div>
									
								
									
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Complete matching</button>
										
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>













</div>
</div>


		



		@endsection
