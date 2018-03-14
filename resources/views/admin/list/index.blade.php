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
				<span class="h3" style="color:white;">
					<i class="fa fa-table"></i>
					Total entries :{{$totalMatchesMade}}
				</span>
				 &nbsp;&nbsp;
				 <span class="h3" style="color:white;">
					<i class="fa fa-table"></i>
					Total amount paid out : N 
					<?php
					$number = $totalAmountPaidOut*1000;
					$amountInNaira =  number_format($number, 2, '.', ',');
					echo $amountInNaira;
					?>
				</span>
			</div>

			@if(Session::has('notification'))
          <p class="alert alert-success alert-sm alert-dismissable">{{Session::get('notification')}}</p>
        @endif

			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin table-bordered dataTable">
					<thead>
					<tr>
						<th>S/N</th>
						<th>Username(s)</th>
						<th class='hidden-350'>Match date</th>
						<th class='hidden-1024'>Amount</th>
						<th class='hidden-480'>Status/Action</th>
					</tr>
					</thead>
					<tbody>
				
				
				<?php $counter=1;?>
				@foreach($matchusers as $matchuser)
	

					<tr>
					<td>{{$counter}}</td>
						<td>
						<span><label>Gh : </label>{{$matchuser->userForGh->username}}</span>
						<br>
						<span><label>Ph : </label>{{$matchuser->userForPh->username}}</span>
						</td>
						<td class='hidden-350'>{{$matchuser->created_at}}</td>
						<td class='hidden-1024'>
						<span><label>Gh : </label>{{$matchuser->ghelprequest->amount}}</span>
						<br>
						<span><label>Ph : </label>{{$matchuser->helprequest->amount}}</span>
						</td>

						<?php
							if($matchuser->approval=='0'){
								$status='Processing';
							}elseif ($matchuser->approval=='1') {
								$status="Awaiting confirmation";
							}elseif ($matchuser->approval=='2') {
								$status="Completed";
							}else{
								$status='Ph user declined';
							}
						?>

						<td class='hidden-480'>
						<a href="" disabled class="btn btn-sm btn-info">
							{{$status}}
						</a>

						<!-- Single button -->
	@if($matchuser->approval!='2')					
<div class="btn-group">
  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
    Unmatch <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">

    <li>
    <a href="{{URL::to('/admin/matchlist/unmatch/'.$matchuser->phuser_id.'/'.$matchuser->ghelprequest_id)}}">Unmatch users
    </a>
    </li>

    <li>
    <a href="{{URL::to('/admin/matchlist/unmatchandblock/'.$matchuser->phuser_id.'/'.$matchuser->ghelprequest_id)}}">Unmatch and block PH user
    </a>
    </li>

    <li><a href="{{URL::to('/admin/matchlist/unmatchandconfirmphuser/'.$matchuser->ghuser_id.'/'.$matchuser->ghelprequest_id.'/'.$matchuser->helprequest_id)}}">Unmatch and confirm PH user (block GH user)
    </a>
    </li>
    
  </ul>
</div>
@endif

<a href="" disabled class="btn btn-sm btn-default">
							....
						</a>

						</td>

					</tr>

					<?php $counter++;?>
				@endforeach

					</tbody>
				</table>

		<br>		
<center>

	{{ $matchusers->links() }}
</center>
				

			</div>
		</div>
	</div>
</div>









</div>
</div>


		



		@endsection
