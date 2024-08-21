<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<a href="{{route('logout',)}}">Logout</a>
<a href="{{route('category.index',)}}">Categories</a>
<a href="{{route('product.index',)}}">Products</a>
<a href="{{route('order.index',)}}">Orders</a>
<a href="{{route('cart.index',)}}">Cart</a>

<h1>Create role</h1>
<div class="container mt-6">
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger mt-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{route('roles.store')}}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1">
                </div>
                @foreach($permissions as $permission)
                    <div class="form-group form-check">
                        <input type="checkbox" value="{{$permission->id}}" name="permissions[]" class="form-check-input" id="exampleCheck{{$permission->id}}">
                        <label class="form-check-label" for="exampleCheck{{$permission->id}}">{{$permission->name}}</label>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>

