@extends('master')
@section('content')
<link rel="stylesheet" type="text/css" href="css/login.css">
    <div class="container">
        <div id="content">
            <form action="" method="post" class="beta-form-checkout">
            @csrf
                <div class="row">
                    <div class="col-sm-3"></div>
                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                            {{$err}}
                            @endforeach
                        </div>
                    @endif
                    @if(Session::has('thanhcong'))
                        <div class="alert alert-success">{{Session::get('thanhcong')}}</div>
                    @endif
                    <div class="col-sm-6">
                        <h5 style="color: lawngreen; font-size: 30px; font-weight: bold" class="card-title text-center">Đăng nhập </h5>
                        <div class="space20">&nbsp;</div>
                        <div class="form-block" style="color:gold; font-size: 20px ">
                            <label for="email">Email address*</label>
                            <input name="email" type="email"  class="form-control "  placeholder="Email " required autofocus>
                        </div>
                        <div class="form-block" style="color:gold; font-size: 20px ">
                            <label for="your_last_name">Fullname*</label>
                            <input name="fullname" type="text"  class="form-control "  placeholder="fullname " required autofocus>
                        </div>
                        <div class="form-block" style="color:gold; font-size: 20px ">
                            <label for="adress">Address*</label>
                            <input name="address" type="text"  class="form-control "  placeholder="address " required autofocus>
                        </div>
                        <div class="form-block" style="color:gold; font-size: 20px ">
                            <label for="phone">Phone*</label>
                            <input name="phone" type="text"  class="form-control "  placeholder="phone " required autofocus>
                        </div>
                        <div class="form-block" style="color:gold; font-size: 20px ">
                            <label for="phone">Password*</label>
                            <input name="password" type="password" id="password" class="form-control "  placeholder="password " required autofocus>
                        </div>
                        <div class="form-block" style="color:gold; font-size: 20px ">
                            <label for="phone">Re password*</label>
                            <input name="re_password"  id="confimPassword" type="password"  class="form-control "  placeholder="re_password " required autofocus>
                            <small id="notice" style="display:none;color: red">Password is incorrect</small>
                        </div>
                        <div class="form-block">
                            <button style=" font-size: 20px" type="submit" id="submit"class="btn btn-success">Register</button>
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </form>
        </div> <!-- #content -->
    </div> <!-- .container -->
    <script>
        var x=setInterval(function(){
            if(document.getElementById('password').value==""){
               document.getElementById('confimPassword').disabled=true;
           }else{
            document.getElementById('confimPassword').disabled=false;
           }
        },10);

        var checkingPass=setInterval(function(){
            var pass=document.getElementById('password').value;
                var confimPass=document.getElementById('confimPassword').value;
                if(pass!=""){
                    if(pass!=confimPass){
                        document.getElementById('notice').style.display="";
                        document.getElementById('submit').disabled=true;
                    }else{
                        document.getElementById('notice').style.display="none";
                        document.getElementById('submit').disabled=false;
                    }
                }
        },10);
    </script>
@endsection
