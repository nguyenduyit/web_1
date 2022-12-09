@extends('admin.adminHome')
@section('admin_content')

@if (session('status'))
  <h6 class="alert alert-success">{{ session('status') }}</h6>
@endif

<form action="{{route('district.update',$district->id)}}" method="POST">
  @csrf
  @method('put')
<div class="bg-light min-vh-100 d-flex flex-row align-items-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="card mb-4 mx-4">
              <div class="card-body p-4">
                <h1>Thêm Quận</h1>
                <p class="text-medium-emphasis">Quận</p>
                <div class="input-group mb-3"><span class="input-group-text">
                    </span>
                  
                  <input class="form-control" name="faculty" value="{{$district->name}}"  type="text" placeholder="Quận">
                    
                </div>
               
                <button class="btn btn-block btn-success" type="submit">Cập nhật</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</form>

@stop