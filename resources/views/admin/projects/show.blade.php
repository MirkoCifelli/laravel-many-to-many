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
                            <a href="{{ route('admin.types.show', ['type' => $project->type->id]) }}">
                                {{ $project->type->title }}
                            </a>
                        </h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
