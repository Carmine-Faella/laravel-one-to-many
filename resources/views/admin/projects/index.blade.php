@extends('layouts.admin')

@section('content')
<a href="{{route('admin.projects.create')}}" class="btn btn-primary">Crea una nuova card</a>
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Titolo</th>
        <th scope="col">Azioni</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($projects as $project)
          <tr>
            <td>{{ $project->id }}</td>
            <td>{{ $project->title }}</td>
            <td class="d-flex">
              <div>
                <a class="btn btn-primary" href="{{route('admin.projects.show', $project->slug)}}">VEDI</a>
              </div>
              <div class="px-2">
                <a href="{{route('admin.projects.edit', ['project' => $project->slug])}}" class="btn btn-info text-white">Modifica</a>
              </div>
              <form action="{{ route('admin.projects.destroy', ['project' => $project->slug]) }}" method="POST" onsubmit="return confirm('Vuoi Eliminare?');">
                @csrf
                @method('DELETE')
  
                <button type="submit" class="btn btn-danger">Elimina</button>
              </form>
  
            </td>

          </tr>
        @endforeach
    </tbody>
  </table>

@endsection