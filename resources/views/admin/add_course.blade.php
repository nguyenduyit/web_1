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

<form action="{{route('course.store')}}" method="POST">
  {{csrf_field()}}
<div class="bg-light min-vh-100 d-flex flex-row align-items-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="card mb-4 mx-4">
              <div class="card-body p-4">
                <h1>Thêm khoá</h1>
                <p class="text-medium-emphasis">Khoá</p>
                <div class="input-group mb-3"><span class="input-group-text">
                    </span>
                  <input class="form-control" name="course" value="{{old('course')}}" type="text" placeholder="KHoá">
                </div>
               
                <button class="btn btn-block btn-success" type="submit">Thêm</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</form>
@stop