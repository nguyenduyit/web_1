@extends('student.home')
@section('content')

@if (session('status'))
  <h6 class="alert alert-success">{{ session('status') }}</h6>
@endif



<form action="{{URL::to('student/save-profile/'.$student->id)}}" method="POST">
  {{csrf_field()}}
<div class="bg-light min-vh-100 d-flex flex-row align-items-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="card mb-4 mx-4">
              <div class="card-body p-4">
                <p class="text-medium-emphasis">Quận</p>
                <select id="district-id" name="district_id" class="form-select" aria-label="Default select example">
                  @foreach($district as $key)
                        @if($student->district!=null)
                      <option {{$key->id==$student->district->id ? 'selected' : ''}} value="{{$key->id}}">{{$key->name}}</option>
                        @else 
                        <option  value="{{$key->id}}">{{$key->name}}</option>
                        @endif
                  @endforeach
                </select>
                <p class="text-medium-emphasis">Phường</p>
                <select id="ward-dropdown" name="ward_id" class="form-select" aria-label="Default select example">
                 
                </select>
                <p class="text-medium-emphasis">Phone</p>
                <input type="text" name="phone" placeholder="Số điện thoại">
               
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
            $('#district-id').on('change', function () {
                var idDistrict = this.value;
                $("#ward-dropdown").html('');
                $.ajax({
                    url: "{{url('api/fetch-ward')}}",
                    type: "GET",
                    data: {
                        district_id: idDistrict,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#ward-dropdown').html('<option value="">-- Select Ward --</option>');
                        $.each(result.ward, function (key, value) {
                            $("#ward-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        // $('#city-dropdown').html('<option value="">-- Select City --</option>');
                    }
                });
            });
  
            
  
        });
    </script>
@stop