@extends('layouts.admin')

@section('content')
<a href="{{route('admin.projects.create')}}" class="btn btn-primary">Crea una nuova card</a>
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Titolo</th>
        <th scope="col">Slug</th>
        <th scope="col">Projects</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($types as $type)
          <tr>
            <td>{{ $type->id }}</td>
            <td>{{ $type->name }}</td>
            <td>{{ $type->slug }}</td>
            <td>{{ count($type->projects) }}</td>
          </tr>
        @endforeach
    </tbody>
  </table>

@endsection