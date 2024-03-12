@extends('layouts.app')

@section('page-title', $project->title . 'Edit')

@section('main-content')
    <h1 class="text-center">
        {{ $project->title }}
    </h1>

    <div class="row">
        <div class="col py-4">
            <div class="container">
                <div class="mb-4">
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">
                        Torna all'index del project
                    </a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.projects.show', ['project' => $project->slug]) }}" method="POST"
                    enctype="multipart/form-data">

                    @csrf

                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Titolo <span class="text-danger">*</span></label>
                        <input value="{{ old('title', $project->title) }}" type="text"
                            class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                            placeholder="Inserisci il titolo..." maxlength="255">
                        @error('title')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Thumb</label>
                        <input value="{{ old('slug', $project->slug) }}" type="text"
                            class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                            placeholder="Inserisci la slug..." maxlength="255">
                        @error('slug')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="3"
                            placeholder="Inserisci il Content...">{{ old('content', $project->content) }}</textarea>
                        @error('content')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="cover_img" class="form-label">Cover image</label>
                        <input class="form-control" type="file" id="cover_img" name="cover_img">
        
                        @if ($project->cover_img != null)
                            <div class="mt-2">
                                <h4>
                                    Copertina attuale:
                                </h4>
                                <img src="/storage/{{ $project->cover_img }}" style="max-width: 400px;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="delete_cover_img" name="delete_cover_img">
                                    <label class="form-check-label" for="delete_cover_img">
                                        Rimuovi immagine
                                    </label>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="type_id" class="form-label">Type</label>
                        <select name="type_id" id="type_id" class="form-select">
                            <option value="" {{ old('type_id') == null ? 'selected' : '' }}>
                                Seleziona un type...
                            </option>
                            @foreach ($types as $type)
                                <option {{ old('type_id', $type->type_id) == $type->id ? 'selected' : '' }}
                                    value="{{ $type->id }}">
                                    {{ $type->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tag</label>

                        <div>
                            @foreach ($technologies as $technology)
                                <div class="form-check form-check-inline">
                                    <input {{-- Se c'è l'old, vuol dire che c'è stato un errore --}}
                                        @if ($errors->any()) {{-- Faccio le verifiche sull'old --}}
                                            {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}
                                        @else
                                            {{-- Faccio le verifiche sulla collezione --}}
                                            {{ $project->technologies->contains($technology->id) ? 'checked' : '' }} @endif
                                        class="form-check-input" type="checkbox" id="technology-{{ $technology->id }}"
                                        name="technologies[]" value="{{ $technology->id }}">
                                    <label class="form-check-label"
                                        for="technology-{{ $technology->id }}">{{ $technology->title }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-warning w-100">
                            Modifica
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
