@extends('admin.adminHome')
@section('admin_content')

@if (session('status'))
  <h6 class="alert alert-success">{{ session('status') }}</h6>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{route('student.update',$student->id)}}" method="POST">
  {{csrf_field()}}
  @method('put')
<div class="bg-light min-vh-100 d-flex flex-row align-items-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="card mb-4 mx-4">
              <div class="card-body p-4">
                <h1>Thêm sinh viên</h1>
                <p class="text-medium-emphasis">Sinh viên</p>
               
                <div class="input-group mb-3"><span class="input-group-text">
                    </span>
                  <input class="form-control" name="student_maso" value="{{$student->maso}}" type="text" placeholder="Mã Số">
                </div>
                <div class="input-group mb-3"><span class="input-group-text">
                    </span>
                  <input class="form-control" name="student_name" value="{{$student->name}}" type="text" placeholder="Họ và tên">
                </div>
                <p class="text-medium-emphasis">Khoá</p>
                <select name="course_id" class="form-select" aria-label="Default select example">
                  @foreach($course as $key)
                      <option {{$key->id==$student->course->id ? 'selected' : ''}} value="{{$key->id}}">{{$key->sokhoa}}</option>
                  @endforeach
                </select>
                <p class="text-medium-emphasis">Khoa</p>
                <select id="faculty-id" name="faculty_id" class="form-select" aria-label="Default select example">
                  @foreach($faculty as $key)
                      <option {{$key->id==$student->faculty->id ? 'selected' : ''}} value="{{$key->id}}">{{$key->name}}</option>
                  @endforeach
                </select>
                <p class="text-medium-emphasis">Ngành</p>
                <select id="major-dropdown" name="major_id" class="form-select" aria-label="Default select example">
                 
                </select>
               
               
              </div>
              <button class="btn btn-block btn-success" type="submit">Thêm</button>
            </div>
          </div>
        </div>
      </div>
    </div>
</form>
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
                        $('#major-dropdown').html('<option value="">-- Select Major --</option>');
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
@stop