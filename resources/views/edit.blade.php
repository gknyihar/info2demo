@extends('layout')

@section('content')
    <div class="container my-4 flex-grow-1">

        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('index')}}">Kezdőlap</a></li>
                <li class="breadcrumb-item"><a href="{{route('users')}}">Felhasználók</a></li>
                <li class="breadcrumb-item"><a href="{{route('tasks.index', $task->user)}}">{{$task->user->name}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$task->title}}</li>
            </ol>
        </nav>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <h5 class="card-title">
                    Feladat szerkesztése
                </h5>
                <form method="post" action="{{route('tasks.update', $task)}}">
                    @csrf
                    @method("put")
                    <div class="mb-3">
                        <label for="title" class="form-label">Cím</label>
                        <input type="text" id="title" name="title" value="{{old('title') ? old('title') : $task->title}}"
                               class="form-control @error('title') is-invalid @enderror">
                        @error('title')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Leírás</label>
                        <textarea id="description" name="description"
                                  class="form-control @error('description') is-invalid @enderror"
                                  rows="10">{{old('description') ? old('description') : $task->description}}</textarea>
                        @error('description')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Mentés</button>
                </form>
            </div>
        </div>

    </div>
@endsection
