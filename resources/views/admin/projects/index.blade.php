@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-bordered my-3">
                    <thead>
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Type Id</th>
                        <th scope="col">Description</th>
                        <th scope="col">Stack</th>
                        <th scope="col">Functions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects_db as $project)
                        <tr>
                            <th scope="row">{{$project->id}}</th>
                            <td>{{$project->slug}}</td>
                            <td>{{$project->type_id}}</td>
                            <td>{{$project->desc}}</td>
                            <td>{{ ucwords(implode(', ', explode('/', $project->stack)))}}.</td>
                            <td>
                                <a href=" {{ route('admin.projects.show', $project->id) }} " class="btn btn-success">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href=" {{ route('admin.projects.edit', $project->id) }} " class="btn btn-warning">
                                    <i class="fa-solid fa-gear"></i>
                                </a>

                                <form action="{{ route('admin.projects.destroy', $project->id)}}" method="POST" onsubmit="return confirm('Do you want to remove this project from the database?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>                            
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-12 pb-3">
                <a href=" {{ route('admin.projects.create') }} " class="btn btn-primary">
                    Add One More
                </a>
            </div>
        </div>
    </div>
@endsection