@extends('layouts.default')
 
@section('content')

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TakeAction</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="css/app.css">

    </head>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @if (Auth::check())
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ url('/login') }}">Login</a>
                    <a href="{{ url('/register') }}">Register</a>
                @endif
            </div>
        @endif
        
    </div>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Petitions CRUD</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('petitionCRUD.create') }}"> Create New Petition</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>User</th>
            <th>Title</th>
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>
    @foreach ($petitions as $key => $petition)
    <tr>
        <td>{{ $petition->user->name }} (<i>{{ $petition->user->email }}</i>)</td>
        <td>{{ $petition->title }}</td>
        <td>{{ $petition->description }}</td>

        <td>
            <a class="btn btn-info" href="{{ route('petitionCRUD.show',$petition->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('petitionCRUD.edit',$petition->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['petitionCRUD.destroy', $petition->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>

    {!! $petitions->render() !!}

@endsection