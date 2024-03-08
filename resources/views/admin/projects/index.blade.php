@extends('layouts.app')

@section('page-title', 'Tutti i Project')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Tutti i Project
                    </h1>

                    <div class="mb-4">
                        <a href="{{ route('admin.projects.create') }}" class="btn btn-success w-100 fs-5">
                            + Aggiungi
                        </a>
                    </div>

                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Technology</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <th scope="row">{{ $project->id }}</th>
                                        <td>{{ $project->title }}</td>
                                        <td>{{ $project->slug }}</td>
                                        <td>
                                            @if ($project->type != null)
                                                <a href="{{ route('admin.types.show', ['type' => $project->type->slug]) }}">
                                                    {{ $project->type->title }}
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <div>
                                                @forelse ($project->technologies as $technology)
                                                    <a href="{{ route('admin.technologies.show', ['technology' => $technology->slug]) }}"
                                                        class="badge rounded-pill text-bg-primary">
                                                        {{ $technology->title }}
                                                    </a>
                                                @empty
                                                    -
                                                @endforelse
                                            </div>
                                        </td>
                                        <td>{{ $project->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.projects.show', ['project' => $project->slug]) }}"
                                                class="btn btn-xs btn-primary">
                                                Show
                                            </a>
                                            <a href="{{ route('admin.projects.edit', ['project' => $project->slug]) }}"
                                                class="btn btn-warning my-2">
                                                Modifica
                                            </a>
                                            <form
                                                onsubmit="return confirm('Sei sicuro di voler eliminare questo elemento');"
                                                class="my-2 d-inline-block"
                                                action="{{ route('admin.projects.destroy', ['project' => $project->slug]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    Elimina
                                                </button>

                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
