@extends('admin.adminHome')
@section('admin_content')

@if (session('status'))
  <h6 class="alert alert-success">{{ session('status') }}</h6>
@endif
<table class="table table-striped">
  <thead>
    <tr>
      <!-- <th scope="col">STT</th> -->
      <th scope="col">Quận</th>
      <th scope="col">Phường</th>
      
    </tr>
  </thead>

  <tbody>
@foreach($ward as $key)
    <tr>
      <!-- <th scope="row">{{$key->id}}</th> -->
      <td>{{$key->district->name}}</td>
      <td>{{$key->name}}</td>
      <td><form action="{{route('ward.destroy',$key->id )}}", method="POST">
            @csrf
            @method('delete')
            <button onClick="confirm('Delete?')" class="btn btn-block btn-success" type="submit">Xoá</button>
            <button class="btn btn-block btn-success"> <a href="{{route('ward.edit', $key->id )}}">
            Đổi tên
          </a></button>
        </form></td>
    </tr>
@endforeach
  </tbody>
</table>
@endsection