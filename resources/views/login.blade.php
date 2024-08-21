<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<h1 style="margin: auto; width:9%; padding: 10px;">Login</h1>
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="post" action="{{route('logincreate')}}">
    @csrf
    <div class="input-group mb-3" style="width: 800px; margin: auto; padding-top: 15px">
        <input type="email" name="email" class="form-control" placeholder="Email" aria-label="email" aria-describedby="basic-addon2">
    </div>
    <div class="input-group mb-3" style="width: 800px; margin: auto; padding-top: 15px">
        <input type="password" name="password" class="form-control" placeholder="Password" aria-label="password" aria-describedby="basic-addon2">
    </div>
    <div class="" style="margin: auto; width: 7%; padding: 10px;">
        <button type="submit" class="btn btn-success">Login</button>
    </div>
</form>
    <div style="margin: auto; width:12%; padding: 10px;">
        <a style="color: green; background-color: transparent; text-decoration: none;" href="{{route('register.create')}}">Not Registered yet?</a>
    </div>
</body>
</html>

