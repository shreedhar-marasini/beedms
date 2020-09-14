@extends('layouts.app')

@section('content')

<style>
 .check{
     text-align: center;
     padding-top: 10px;
     border-bottom: 1px solid black;
 }
 .area p{
     font-size: 13px;
     text-align: center;
     font-family: Arial, Helvetica, sans-serif;
    
 }
  
</style>
    <div class="login-box-body">

        <p class="login-box-msg">Provide your login information.</p>

        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="form-group has-feedback">
                <input type="email" name="email" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group has-feedback">
                <input type="password"  name="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>


        <a class="btn btn-link" href="{{ route('password.request') }}" >
            Forgot Your Password?
        </a>

   

    </div>
<div class="login-box-footer" style="border-radius: 10px">
    <div class="check">

        <label> Use Default User Credential for Login.</label>
    </div>
   
       <div class="area">
            <p>Username 1: superAdmin@youngminds.com.np</p>
            <p>Password 1: youngminds</p>
            <p>Username 2: admin@youngminds.com.np</p> 

            <p>Password 2: youngminds</p>
       </div>
      
 

     



</div>
 


@endsection


