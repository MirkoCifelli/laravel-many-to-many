@extends('layouts.app')

@section('page-title', '$project->title')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        {{ $project->title }}
                    </h1>

                    <h2>
                        Slug: {{ $project->slug }}
                    </h2>

                    <p>
                        {{ $project->content }}
                    </p>


                    @if ($project->type != null)
                        <h2>
                            Categoria:
                            <a href="{{ route('admin.types.show', ['type' => $project->type->slug]) }}">
                                {{ $project->type->title }}
                            </a>
                        </h2>
                    @endif

                    <div>
                        Tag:
                        @forelse ($project->technologies as $technology)
                            <a href="{{ route('admin.technologies.show', ['technology' => $technology->slug]) }}"
                                class="badge rounded-pill text-bg-primary">
                                {{ $technology->title }}
                            </a>
                        @empty
                            -
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
