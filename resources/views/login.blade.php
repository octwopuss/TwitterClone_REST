<!DOCTYPE html>
<html>
<head>
	<title>Selamat Datang di Bagi Momen <3 </title>		
		<link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/lumen/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<style type="text/css">
			body{
				background-color: #c3c9cc;
			}		

			.form-heading { color:#fff; font-size:23px;}
			.panel h2{ color:#444444; font-size:18px; margin:0 0 8px 0;}
			.panel p { color:#777777; font-size:14px; margin-bottom:30px; line-height:24px;}
			.login-form .form-control {
			  background: #f7f7f7 none repeat scroll 0 0;
			  border: 1px solid #d4d4d4;
			  border-radius: 4px;
			  font-size: 14px;
			  height: 50px;
			  line-height: 50px;
			}
			.main-div {
			  background: #ffffff none repeat scroll 0 0;
			  border-radius: 2px;
			  margin: 10px auto 30px;
			  max-width: 38%;
			  padding: 50px 70px 70px 71px;
			}

			.login-form .form-group {
			  margin-bottom:10px;
			}
			.login-form{ text-align:center;}
			.forgot a {
			  color: #777777;
			  font-size: 14px;
			  text-decoration: underline;
			}
			.login-form  .btn.btn-primary {
			  background: #f0ad4e none repeat scroll 0 0;
			  border-color: #f0ad4e;
			  color: #ffffff;
			  font-size: 14px;
			  width: 100%;
			  height: 50px;
			  line-height: 50px;
			  padding: 0;
			}
			.forgot {
			  text-align: left; margin-bottom:30px;
			}
			.botto-text {
			  color: #ffffff;
			  font-size: 14px;
			  margin: auto;
			}
			.login-form .btn.btn-primary.reset {
			  background: #ff9900 none repeat scroll 0 0;
			}
			.back { text-align: left; margin-top:10px;}
			.back a {color: #444444; font-size: 13px;text-decoration: none;}

			</style>
</head>
<body id="LoginForm">
	<div class="container">		
		<div class="login-form">
			<div class="main-div">
    			<div class="panel">
   					<h2>Bagi Momen <i class="fa fa-heart fa-xs"></i></h2>
   					<p>Sosial sosial media-an</p>
   				</div>
    			<form id="Login" action="{{route('auth.user')}}"" method="POST">
    				{{ csrf_field() }}
    				@if(Session::has('error'))
    				<div class="alert alert-dismissible alert-warning">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					  {{Session::get('error')}}
					</div>		
					@endif
					<div class="form-group">
           				<input type="text" class="form-control" id="inputEmail" placeholder="Username" name="username" value="@if(Session::has('username')) {{Session::get('username')}} @endif">
					</div>
        			<div class="form-group">	
            			<input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
        			</div>
        			<div class="form-group clearfix">
						<label class="fancy-checkbox element-left">
							<input type="checkbox" name="remember">
							<span>Remember me</span>
						</label>
					</div>
        			<!-- <div class="forgot">
        				<a href="reset.html">Forgot password?</a>
					</div> -->
        			<button type="submit" class="btn btn-outline-primary" style="width: 100%;">Login</button>
    			</form>
    		</div>
		</div>
	</div>
<script type="text/javascript" src="https://bootswatch.com/_vendor/jquery/dist/jquery.min.js"></script>
<script src="https://bootswatch.com/_vendor/popper.js/dist/umd/popper.min.js"></script>
<script src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>