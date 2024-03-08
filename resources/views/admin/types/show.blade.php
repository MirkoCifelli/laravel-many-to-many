@extends('layouts.app')

@section('page-title', '$type->title')

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        {{ $type->title }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center text-success">
                        Tutti i project associati a questa categoria
                    </h2>

                    <ul>
                        @foreach ($type->projects as $project)
                            <li>
                                <a href="{{ route('admin.projects.show', ['project' => $project->slug]) }}">
                                    {{ $project->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
