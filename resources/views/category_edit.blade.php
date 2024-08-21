<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<h1>Edit</h1>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="post" action="{{route('category.update',$category)}}">
    @csrf
    @method('put')
    <div class="input-group mb-3" style="width: 800px; margin: auto; padding-top: 15px">
        <input type="name" name="name" class="form-control" placeholder="Name" aria-label="name" aria-describedby="basic-addon2">
    </div>
    <div class="input-group mb-3" style="width: 800px; margin: auto; padding-top: 15px">
        <input type="category" name="category" class="form-control" placeholder="Category" aria-label="category" aria-describedby="basic-addon2">
    </div>
    <div class="btn-group position-absolute bottom-50 end-50">
        <button type="submit" class="btn btn-success">Send</button>
    </div>
</form>
</body>
</html>

