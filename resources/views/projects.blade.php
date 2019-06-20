@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Projects</div>

                <div class="card-body">
                    @if ($projects->count())
                        <ul class="list-group">
                            @foreach ($projects as $project)
                                <li class="list-group-item">
                                    <span class="pull-left">
                                        Name: {{ $project->name }} |
                                        Date: {{ $project->created_at }}
                                    </span>

                                    <span class="pull-right">
                                        <form class="" action="{{ route('projects.destroy', [$project->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                X
                                            </button>
                                        </form>
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="alert alert-info">There Is No Projects In This Tanant</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Projects</div>

                <form action="{{ route('projects.store') }}" method="post">
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Project Name ...">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
