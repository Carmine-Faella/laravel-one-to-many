@extends('layouts.admin')

@section('content')

    <h1 class="text-center pt-3">Crea una nuova Card</h1>

    <div class="py-5 text-center">
        <a href="{{route('admin.projects.index')}}" class="btn btn-secondary">Torna alla lista</a>
    </div>

    <form method="POST" action="{{route('admin.projects.store')}}">

        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Titolo:</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Descrizione (max 1000)(opzionale):</label>
            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content">{{ old('content') }}</textarea>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cover_image" class="form-label">Url dell'immagine:</label>
            <input type="text" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image" value="{{ old('cover_image') }}">
            @error('cover_image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug:</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}">
            @error('slug')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        
        <div class="py-3">
            <button type="submit" class="btn btn-primary">Salva</button>
        </div>
    </form>

@endsection