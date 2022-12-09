


<!DOCTYPE html>
<html>
    
<head>
	<title> Sign up</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
   	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
	


	<script src="sweetalert2.all.min.js"></script>

	
	<link href="/css/login.css" rel="stylesheet">
   
</head>


<body>
	
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
		@if ($errors->any())
    		<div  id="ERROR" class="alert alert-danger" style="display:none;">
        		<ul>
            		@foreach ($errors->all() as $error)
                		<li>{{ $error }}</li>
            		@endforeach
        		</ul>
    		</div>
		@endif
		@include('sweetalert::alert')

		
       
		
		
			<div class="user_card">
			
				<div class="d-flex justify-content-center">
					
					<div class="brand_logo_container">
						<img src="/images/logoctu.png" class="brand_logo" alt="Logo">
						
					</div>
					
				</div>
				
				<div class="d-flex justify-content-center form_container">
					<form action="{{URL::to('student/post-signup')}}", method="POST">
						@csrf
					
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="username" class="form-control input_user" value="{{old('username')}}"  placeholder="MSSV">
						</div>
                        <div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="name" class="form-control input_user" value="{{old('name')}}"  placeholder="Tên của bạn">
						</div>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fa fa-envelope"></i></span>
							</div>
							<input type="email" name="email" class="form-control input_user" value="{{old('email')}}"  placeholder="Email">
						</div>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fa fa-key"></i></span>
							</div>
							<input type="password" name="password" id="pass_signup" class="form-control input_user"  placeholder="Password">
							<span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></span>
						</div>
                        <div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fa fa-check-circle"></i></span>
							</div>
                            <select name="course_id" class="form-select" aria-label="Default select example">
                                @foreach($course as $key)
                                    <option {{$key->id==1 ? 'selected' : ''}} value="{{$key->id}}">{{$key->sokhoa}}</option>
                                 @endforeach
                            </select>
						</div>

                        <div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fa fa-check-circle"></i></span>
							</div>
                            <select id="faculty-id" name="faculty_id" class="form-select" aria-label="Default select example">
                                @foreach($faculty as $key)
                                    <option {{$key->id==2 ? 'selected' : ''}} value="{{$key->id}}">{{$key->name}}</option>
                                @endforeach
                             </select>
						</div>


                        <div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fa fa-check-circle"></i></span>
							</div>
                            <select name="major_id" id="major-dropdown" class="form-select" aria-label="Default select example">
                            </select>
						</div>
                        <div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fa fa-phone"></i></span>
							</div>
							<input type="text" name="phone" value="{{old('phone')}}"  class="form-control input_user"  placeholder="SĐT">
						</div>
						
						
							<div class="d-flex justify-content-center mt-3 login_container">
				 	<button type="submit" name="button" class="btn login_btn">Signup</button>
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
			
			</div>
			
		</div>
	</div>
	
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#faculty-id').on('change', function () {
                var idFaculty = this.value;
                $("#major-dropdown").html('');
                $.ajax({
                    url: "{{url('api/fetch-major')}}",
                    type: "GET",
                    data: {
                        faculty_id: idFaculty,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#major-dropdown').html('<option value="">-- Ngành --</option>');
                        $.each(result.major, function (key, value) {
                            $("#major-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        // $('#city-dropdown').html('<option value="">-- Select City --</option>');
                    }
                });
            });
  
            
  
        });
    </script>


	<script>
		var has_error= {{$errors->count() > 0 ? 'true' : 'false'}}
		if(has_error){
			Swal.fire({
				title: 'Error',
				type: 'error',
				html:	jQuery("#ERROR").html(),
				showCloseButton: true,
				
			})

		}
		
	</script>

	<script>
		$("body").on('click', '.toggle-password', function() {
				$(this).toggleClass("fa-eye fa-eye-slash");
				var input = $("#pass_signup");
				if (input.attr("type") === "password") {
					input.attr("type", "text");
				} else {
					input.attr("type", "password");
				}

				});
	</script>
</html>
