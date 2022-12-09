@extends('admin.adminHome')
@section('admin_content')

@if (session('status'))
  <h6 class="alert alert-success">{{ session('status') }}</h6>
@endif
<table class="table table-striped">
  <thead>
    <tr>
      <!-- <th scope="col">STT</th> -->
      <th scope="col">MSSV</th>
      <th scope="col">Họ và tên</th>
      <th scope="col">Khoá</th>
      <th scope="col">Khoa</th>
      <th scope="col">Ngành</th>
      
    </tr>
  </thead>

  <tbody>
@foreach($student as $key)
    <tr>
      <th scope="row">{{$key->maso}}</th>
      <td>{{$key->name}}</td>
      <td>{{$key->course->sokhoa}}</td>
      <td>{{$key->faculty->name}}</td>
      <td>{{$key->major->name}}</td>
      <td><form action="{{route('student.destroy',$key->id )}}", method="POST">
            @csrf
            @method('delete')
            <button onClick="confirm('Delete?')" class="btn btn-block btn-success" type="submit">Xoá</button>
            <button class="btn btn-block btn-success"> <a href="{{route('student.edit', $key->id )}}">
            Điều chỉnh
          </a></button>
        </form></td>
    </tr>
@endforeach
  </tbody>
</table>
@endsection