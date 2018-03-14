@extends('admin.layouts.main')

@section('content')


<div id="main">
<div class="container-fluid">
<div class="page-header">
	<div class="pull-left">
		<h1>Fake receipt reports</h1>
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
			<a href="tables-basic.html">Fake Receipt</a>
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
					<i class="fa fa-table"></i>
					Fake receipt reports
				</h3>
			</div>

			@if(Session::has('notification'))
          <p class="alert alert-success alert-sm alert-dismissable">{{Session::get('notification')}}</p>
        @endif

			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin table-bordered dataTable">
					<thead>
					<tr>
						<th>Name/Email</th>
						<th>Subject</th>
						<th class='hidden-350'>Message</th>
						<th class='hidden-1024'>Reply message</th>
						<th class='hidden-480'>Action</th>
					</tr>
					</thead>
					<tbody>

					<?php $counter=1;?>
				@foreach($inboxs as $inbox)
					
					<tr>
						<td>{{$inbox->sendername}}<br>{{$inbox->senderemail}}</td>
						<td>
						{{$inbox->topic}}
						</td>
						<td class='hidden-350'>
						{{$inbox->message}}
						<label style="float: right" class="label label-info label-sm">
							{{$inbox->created_at}}
						</label>
						</td>
						<td class='hidden-1024'>
							@if($inbox->reply==null)
							 <span class="label label-default">No reply yet</span>
							 @else
							   {{$inbox->reply}}
							   	<label style="float: right" class="label label-info label-sm">
									{{$inbox->updated_at}}
								</label>
							 @endif
						</td>
						<td class='hidden-480'>
							<a href="" class="btn btn-sm btn-default">Reply</a><br>
							<a href="{{URL::to('/admin/inbox/delete/'.$inbox->id)}}" class="btn btn-sm btn-danger">Delete</a>
						</td>
					</tr>

					<div id="myModal{{$inbox->id}}" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title" id="myModalLabel">Reply Message</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						
						<div class="col-sm-12">
						<form action="{{url('admin/inbox/reply')}}" method="POST" class='form-horizontal form-bordered' enctype='multipart/form-data'>
								
								<input type="hidden" name="_token" value="{{csrf_token()}}" />

								<input type="hidden" name="userId" value="{{$inbox->id}}">
								<input type="email" class="disabled" name="userEmail" value="{{$inbox->senderemail}}"><br><br>
								<textarea name="replyMessage" placeholder="Type reply message here">
									
								</textarea>

								<button type="submit" class="btn btn-primary btn-sm"> Reply </button>
						</form>
							
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
			

					<?php $counter++;?>
				@endforeach
					
					</tbody>
				</table>
				<br>		
<center>

	{{ $inboxs->links() }}
</center>
			</div>
		</div>
	</div>
</div>









</div>
</div>


		



		@endsection
