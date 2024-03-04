<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if($project->image != null)
                <div>
                    <img src="{{ asset('storage/'.$project->image)}}">
                </div>
                @endif
                @if($project->type_id != null)
                <div>
                    Type Id: {{$project->type_id}}
                </div>
                @endif
                <div>
                    Project Id: {{$project->id}}
                </div>
                <div>
                    Project Title: {{$project->slug}}
                </div>
                <div>
                    Project Summary: {{$project->desc}}
                </div>
                <div>
                    Project Stack: {{$project->stack}}
                </div>
                <div>
                    Project Type: {{$project->type_id}}
                </div>
                <div>
                    Project Techs:
                    @foreach ($project->technologies as $tech)
                        <br>{{$tech->name}}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>