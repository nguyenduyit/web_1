@extends('admin.adminHome')
@section('admin_content')

@if (session('status'))
  <h6 class="alert alert-success">{{ session('status') }}</h6>
@endif
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Mã số</th>
      <th scope="col">Tên người báo cáo</th>
      <th scope="col">Khoá</th>
      <th scope="col">Khoa</th>
      <th scope="col">Ngành</th>
      <!-- <th scope="col">Status</th> -->
     
    </tr>
  </thead>

  <tbody>
@if($post!=null)
@foreach($post as $key)
<?php
$student=\App\Models\Student::where('id',$key->student->id)->with('course')->with('major')->with('faculty')->first()
?>

    <tr>
      <th scope="row">{{$student->maso}}</th>
      <td>{{$student->name}}</td>
      <td>{{$student->course->sokhoa}}</td>
      <td>{{$student->faculty->name}}</td>
      <td>{{$student->major->name}}</td>
      
     
     
      <td>
       
       
      </td>
      <td>
     
      </td>
        
    </tr>
@endforeach
@endif
  </tbody>
</table>
@endsection