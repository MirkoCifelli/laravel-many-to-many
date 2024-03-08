@extends('layouts.app')

@section('page-title', 'Tutti i Type')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Tutti i type
                    </h1>

                    <div class="mb-4">
                        <a href="{{ route('admin.types.create') }}" class="btn btn-success w-100 fs-5">
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
                                    <th scope="col">Created at</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($types as $type)
                                    <tr>
                                        <th scope="row">{{ $type->id }}</th>
                                        <td>{{ $type->title }}</td>
                                        <td>{{ $type->slug }}</td>
                                        <td>{{ $type->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.types.show', ['type' => $type->slug]) }}"
                                                class="btn btn-xs btn-primary">
                                                Show
                                            </a>
                                            <a href="{{ route('admin.types.edit', ['type' => $type->slug]) }}"
                                                class="btn btn-warning my-2">
                                                Modifica
                                            </a>
                                            <form
                                                onsubmit="return confirm('Sei sicuro di voler eliminare questo elemento');"
                                                class="my-2 d-inline-block"
                                                action="{{ route('admin.types.destroy', ['type' => $type->slug]) }}"
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
