@extends('admin.adminHome')
@section('admin_content')

@if (session('status'))
  <h6 class="alert alert-success">{{ session('status') }}</h6>
@endif
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">Khoa</th>
      <th scope="col">Ngành</th>
      
    </tr>
  </thead>

  <tbody>
@foreach($major as $key)
    <tr>
      <th scope="row"></th>
      <td>{{$key->faculty->name}}</td>
      <td>{{$key->name}}</td>
      <td><form action="{{route('major.destroy',$key->id )}}", method="POST">
            @csrf
            @method('delete')
            <button onClick="confirm('Delete?')" class="btn btn-block btn-success" type="submit">Xoá</button>
            <button class="btn btn-block btn-success"> <a href="{{route('major.edit', $key->id )}}">
            Đổi tên
          </a></button>
        </form></td>
    </tr>
@endforeach
  </tbody>
</table>
@endsection