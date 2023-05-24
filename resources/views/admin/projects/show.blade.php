@extends('layouts.admin')

@section('content')

<h1 class="text-white">Dettagli</h1>

    <div class="card my-5">
        <div class="row g-0">
          <div class="col-3">
            <img src="{{$project->cover_image}}" class="img-fluid rounded-start w-100" alt="{{$project->title}}">
          </div>
          <div class="col">
            <div class="card-body">
              <h5 class="card-title">{{$project->title}}</h5>
              <p class="card-text">{{$project->content}}</p>
              <p class="card-text"><small class="text-body-secondary">{{$project->slug}}</small></p>
              <a href="{{route('admin.projects.index')}}" class="btn btn-secondary">Torna alla lista</a>
            </div>
          </div>
        </div>
      </div>

@endsection