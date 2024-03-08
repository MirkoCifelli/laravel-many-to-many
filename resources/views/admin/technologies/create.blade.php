@extends('layouts.app')

@section('page-title', 'Technologies Creation')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="container">
                <div class="mb-4">
                    <a href="{{ route('admin.technologies.index') }}" class="btn btn-primary">
                        Torna all'index di Technologies
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

                <form action="{{ route('admin.technologies.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Titolo <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" placeholder="Inserisci il Titolo..." maxlength="255" 
                            value="{{ old('title') }}">
                        @error('title')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
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
