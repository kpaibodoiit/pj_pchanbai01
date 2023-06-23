<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/resetPassword.css">
<!------ Include the above in your HEAD tag ---------->
<!DOCTYPE html>
<html>
<head>
	<title>ResetPass Page</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Reset Password</h3>
			</div>
			<div class="card-body">
				<form action="{{ route('auth.resetPassword') }}" method="post">
                    @csrf
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"></span>
						</div>
						<input type="email" class="form-control" placeholder="Email" name="email" value="@if(session('megEmail')){{session('megEmail')}}@endif">					
					</div>
                    <p style="color: crimson"> 
                        @if ($errors->has('email'))
                            {{ $errors->first('email') }}
                        @endif
                    </p>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="Name" name="name" value="@if(session('megName')){{session('megName')}}@endif">
					</div>
                    <p style="color: crimson"> 
                        @if ($errors->has('name'))
                            {{ $errors->first('name') }}
                        @endif
                    </p>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="New Password" name="password" value="@if(session('megPw')){{session('megPw')}}@endif">
					</div>
                    <p style="color: crimson"> 
                        @if ($errors->has('password'))
                            {{ $errors->first('password') }}
                        @endif
                    </p>
					<div>
						@if(session('message'))
							<p style="color:red">
							{{ session('message') }}
							</p>
						@endif
						@if(session('message1'))
							<p style="color:blue">
							{{ session('message1') }}
							</p>
						@endif
					</div>
					<div class="form-group">
						<input type="submit" value="Reset" class="btn float-right login_btn">
					</div>			
				</form>	
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="/register">Sign Up</a>
				</div>
				<div class="d-flex justify-content-center links">
					You have a account!<a href="/login">Login</a>
				</div>
			</div>			
		</div>
	</div>
</div>
</body>
</html>