@extends('layouts.app')

@section('page-title', 'Project Creation')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="container">
                <div class="mb-4">
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">
                        Torna all'index di project
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

                <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Titolo <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" placeholder="Inserisci il Titolo..." maxlength="255" value="{{ old('title') }}">
                        @error('title')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>



                    {{-- <div class="mb-3">
                        <label for="slug" class="form-label">Slug<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                            placeholder="Inserisci Slug..." maxlength="255" value="{{ old('slug') }}">
                        @error('slug')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div> --}}

                    <div class="mb-3">
                        <label for="cover_img" class="form-label">Cover image</label>
                        <input class="form-control" type="file" id="cover_img" name="cover_img">
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content<span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="3"
                            placeholder="Inserisci Content...">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type_id" class="form-label">Type</label>
                        <select name="type_id" id="type_id" class="form-select">
                            <option value="" {{ old('type_id') == null ? 'selected' : '' }}>
                                Seleziona un type...
                            </option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
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
                                    <input {{ in_array($technology->id, old('tecnologies', [])) ? 'checked' : '' }}
                                        class="form-check-input" type="checkbox" id="technology-{{ $technology->id }}"
                                        name="technologies[]" value="{{ $technology->id }}">
                                    <label class="form-check-label"
                                        for="technology-{{ $technology->id }}">{{ $technology->title }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>


                    <div>
                        <button type="submit" class="btn btn-success w-100">
                            Aggiungi
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
