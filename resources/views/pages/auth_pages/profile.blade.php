@extends('layouts.auth_pages')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Profile</li>
      </ol>
    </section>

    <section class="content">
   <!--refereer link-->
          <p class="alert alert-info alert-sm alert-dismissable" style="overflow-x: auto;">
          <?php 
          $phone = base64_encode(Auth::user()->phone);
          $refLink="https://www.laughtercommunity.com/referrer/".$phone;
           ?>
            Your referrer link is : {{$refLink}}
          </p>
        <!--refereer link-->
        @if(Session::has('notification'))
          <p class="alert alert-success alert-sm alert-dismissable">{{Session::get('notification')}}</p>
        @endif



    <!-- Main content -->
    <section class="content">

      <div class="row">
        
        <!-- /.col -->
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class=""><a href="#activity" data-toggle="tab">Edit profile</a></li>
              
            </ul>
            <div class="tab-content">
              

              <div class="" id="activity">
                <form name="profile_form" class="form-horizontal" role="form" method="POST" action="{{URL::to('/user_profile')}}">

                 {{ csrf_field() }}

                  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input name="name" type="text" class="form-control" id="inputName" placeholder="Name" value="
                      @if(Auth::user()->name != null)
              {{Auth::user()->name}}
              @else
              {{old('name')}}
              @endif">
                      @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                    </div>
                  </div>
                  <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <label for="inputPhone" class="col-sm-2 control-label">Phone</label>

                    <div class="col-sm-10">
                      <input name="phone" type="@if(Auth::user()->phone != null)
              {{'text'}}
              @else
              {{'number'}}
              @endif" class="form-control" id="inputPhone" placeholder="Name" value="
                      @if(Auth::user()->phone != null)
              {{Auth::user()->phone}}
              @else
              {{old('phone')}}
              @endif">
                      @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                    </div>
                  </div>
                  <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Name" value="
                      @if(Auth::user()->email != null)
              {{Auth::user()->email}}
              @else
              {{old('email')}}
              @endif">
                      @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                    </div>
                  </div>




                  

                  <div class="user-block">
                    
                        
                 
                  

                  <div class="form-group{{ $errors->has('account_name') ? ' has-error' : '' }}">
                    <label for="inputName" class="col-sm-2 control-label">Account Name</label>

                    <div class="col-sm-10">

                      <input type="text" name="account_name" class="form-control" id="inputName" placeholder="Account Name" value="
                      @if(Auth::user()->account_name != null)
              {{Auth::user()->account_name}}
              @else
              {{old('account_name')}}
              @endif" @if(!empty(Auth::user()->account_name))
              {{'disabled'}}
              @endif
              >
                      @if ($errors->has('account_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('account_name') }}</strong>
                                    </span>
                                @endif
                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('account_name') ? ' has-error' : '' }}">
                    <label for="inputExperience" class="col-sm-2 control-label">Account Number</label>

                    <div class="col-sm-10">
                      <input type="
                      @if(Auth::user()->account_no != null)
              {{'text'}}
              @else
              {{'number'}}
              @endif" name="account_no" class="form-control" id="inputSkills" placeholder="Account Number" value="
                      @if(Auth::user()->account_no != null)
              {{Auth::user()->account_no}}
              @else
              {{old('account_no')}}
              @endif" 
              @if(!empty(Auth::user()->account_no))
              {{'disabled'}}
              @endif

              >
                      @if ($errors->has('account_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('account_no') }}</strong>
                                    </span>
                                @endif
                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('bank') ? ' has-error' : '' }} ">
                    <label for="inputSkills" class="col-sm-2 control-label">Bank</label>

                    <div class="col-sm-10">

                      <a href="btn btn-default" class="h4">
                        @if(Auth::user()->bank != null)
                          {{ucwords(Auth::user()->bank)}} bank <br><br>
                        @else
                          {{'Not set'}}
                        @endif
                      </a>

                      <select class="form-control @if(!empty(Auth::user()->account_no))
              {{'hidden'}}
              @endif" name="bank" @if(!empty(Auth::user()->account_no))
              {{'disabled'}}
              @endif>
              <option selected="selected" disabled="disabled">Select bank</option>
            <option value="first">First Bank</option>
<option value="access">Access Bank</option>
<option value="citibank">Citibank</option>
<option value="diamond">Diamond Bank</option>
<option value="ecobank">Ecobank</option>
<option value="fidelity">Fidelity Bank</option>
<option value="fcmb">First City Monument Bank (FCMB)</option>
<option value="fsdh merchant">FSDH Merchant Bank</option>
<option value="gtb">Guarantee Trust Bank (GTB)</option>
<option value="heritage">Heritage Bank</option>
<option value="Keystone">Keystone Bank</option>
<option value="rand merchant">Rand Merchant Bank</option>
<option value="skye">Skye Bank</option>
<option value="stanbic ibtc">Stanbic IBTC Bank</option>
<option value="standard">Standard Chartered Bank</option>
<option value="sterling">Sterling Bank</option>
<option value="sun trust">Suntrust Bank</option>
<option value="union">Union Bank</option>
<option value="uba">United Bank for Africa (UBA)</option>
<option value="unity">Unity Bank</option>
<option value="wema">Wema Bank</option>
<option value="zenith">Zenith Bank</option>

        </select>

        @if ($errors->has('bank'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bank') }}</strong>
                                    </span>
                                @endif
                      


                    </div>
                  </div>


                  <div class="form-group @if(!empty(Auth::user()->account_no))
              {{'hidden'}}
              @endif>">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                            <a href="#">by clicking update, you agree to the terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group @if(!empty(Auth::user()->account_no))
              {{'hidden'}}
              @endif">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Update</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->

         <div class="col-md-2"></div>
      </div>
      <!-- /.row -->
      </div>
    </section>
    <!-- /.content -->
  </div>
          <!-- Map box -->
                        <!-- /. tools -->

                              <!-- ./col -->
            
          <!-- /.box -->

          <!-- Calendar -->
          
               
                <!-- /.col -->
                
                <!-- /.col -->

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection()