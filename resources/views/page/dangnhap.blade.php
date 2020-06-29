@extends('master')
@section('content')
<link rel="stylesheet" type="text/css" href="css/login.css">
<div class="inner-header">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    </div>
    <div class="container">
        <div id="content">
            <form action="" method="post" class="beta-form-checkout">
            @csrf
                <div class="row">
                    <div class="col-sm-3"></div>
                    @if(Session::has('flag'))
                        <div class="alert alert-{{Session::get('flag')}}">{{Session::get('message')}}</div>
                    @endif
                    <div class="col-sm-6">
                        <h5 style="color: lawngreen; font-size: 30px; font-weight: bold" class="card-title text-center">Đăng nhập </h5>
                        @if ($error!="")
                        <p style="color: red">{{ $error }}</p>
                        @endif

                        <div class="space20">&nbsp;</div>
                        <div class="form-block" style="color:gold; font-size: 20px ">
                            <label for="email">Email address*</label>
                            <input name="email" type="email"  class="form-control "  placeholder="Email " required autofocus>
                        </div>
                        <div class="form-block" style="color:gold; font-size: 20px ">
                            <label for="phone">Password*</label>
                            <input name="password" type="password"  class="form-control "  placeholder="password " required autofocus>

                        </div>
                        <div class="form-block">
                            <button style=" font-size: 20px" type="submit" id="submit"class="btn btn-success">Login</button>
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </form>
        </div> <!-- #content -->
    </div> <!-- .container -->
@endsection
