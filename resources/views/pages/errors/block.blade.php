@extends('layouts.auth_pages')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SMILESTEADY
        <small>User Blocked</small>
      </h1>
      
    </section>

    <section class="content">
  
     @if(Session::has('notification'))
          <p class="alert alert-danger alert-sm alert-dismissable h4">{{Session::get('notification')}}</p>
        @endif



        
    <!-- Main content -->
    <section class="content">
      <p class="alert alert-info alert-sm alert-dismissable h4">
          
          <a class="label" href="{{URL::to('/contact')}}">Contact</a> site adminitrator or chat with an online agent.

        </p>
        </section>



        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection()