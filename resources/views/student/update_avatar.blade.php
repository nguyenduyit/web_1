@extends('student.home')

@section('content')

<form action="{{URL::to('student/save-avatar/'.$student->id)}}" enctype="multipart/form-data" method="POST">
    {{ csrf_field() }}
    <img src="{{URL::to('images/'.$student->image)}}" >    
    <input type="file" class="form-control"  name="avatar">
    
    <button type="submit" class="btn btn-success">Update</button>
</form>

<style>

    form {
        margin: 0 auto;
        margin-top: 100px;
    }
    img {
        height: 150px;
        margin-left:100px;
        margin-bottom:20px;
    }
    button {

        margin-top:20px;
        margin-left:120px;
        
    }
</style>
@endsection