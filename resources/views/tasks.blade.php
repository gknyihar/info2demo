@extends('layout')

@section('content')
    <div class="container my-4 flex-grow-1">

        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('index')}}">Kezdőlap</a></li>
                <li class="breadcrumb-item"><a href="{{route('users')}}">Felhasználók</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$user->name}}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col">
                @foreach($tasks as $task)
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="card-title">
                                    {{$task->title}}
                                </h5>
                                @if($task->status == 'new')
                                    <form method="post"
                                          action="{{route('tasks.delete',$task)}}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" name="delete" class="btn btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                            <h6 class="card-subtitle mb-2 {{$status[$task->status]['class'] }}">
                                {{$status[$task->status]['title']}}
                            </h6>
                            <p class="card-text">
                                {{$task->description}}
                            </p>
                            @if($task->status != \App\Models\TaskStatus::DONE)
                                @if($task->status != \App\Models\TaskStatus::IN_PROGRESS)
                                    <form method="post"
                                          action="{{route('tasks.status.in_progress',$task)}}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="submit" class="btn btn-outline-primary" value="Folyamatban"/>
                                    </form>
                                @else
                                    <form method="post"
                                          action="{{route('tasks.status.done',$task)}}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="submit" class="btn btn-outline-primary" value="Done"/>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            Új feladat
                        </h5>
                        <form method="post" action="{{route('tasks.create', $user)}}">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Cím</label>
                                <input type="text" id="title" name="title" value="{{old('title')}}"
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
                                          rows="10">{{old('description')}}</textarea>
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
        </div>

    </div>
@endsection
