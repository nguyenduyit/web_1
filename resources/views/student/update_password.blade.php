
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
    
<head>
	<title> Update Password</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
	<link href="/css/login.css" rel="stylesheet">
   
</head>
<!--Coded with love by Mutiullah Samim-->
<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
		<!-- @if ($errors->any())
    		<div class="alert alert-danger">
        		<ul>
            		@foreach ($errors->all() as $error)
                		<li>{{ $error }}</li>
            		@endforeach
        		</ul>
    		</div>
		@endif -->
		
		
			<div class="user_card">
			
				<div class="d-flex justify-content-center">
					
					<div class="brand_logo_container">
						<img src="/images/logoctu.png" class="brand_logo" alt="Logo">
						
					</div>
					
				</div>
				
				<div class="d-flex justify-content-center form_container">
					<form action="{{URL::to('student/save-password')}}", method="POST">
						@csrf
					
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="username" class="form-control input_user" value="{{ session()->get('student') }}"  placeholder="MSSV">
						</div>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="password" name="password" class="form-control input_user"  placeholder="password">
						</div>
						
						
							<div class="d-flex justify-content-center mt-3 login_container">
				 	<button type="submit" name="button" class="btn login_btn">Update</button>
				   </div>
					</form>
				</div>
				
				<div class="mt-4">
					<!-- <div class="d-flex justify-content-center links">
						Don't have an account? <a href="#" class="ml-2">Sign Up</a>
					</div> -->
					<div class="d-flex justify-content-center links">
						<a href="{{URL::to('/')}}">Login</a>
					
					</div>
				</div>
				@if ($errors->any())
    			<div class="alert alert-warning">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
    			</div>
			@endif
			@if (session('status'))
              			<h6 class="alert alert-success">{{ session('status') }}</h6>
        		@endif
			</div>
			
		</div>
	</div>
</body>
</html>
