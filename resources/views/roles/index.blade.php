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
@role('super-user')
<a href="{{route('roles.index')}}">Roles</a>
@endrole

<h1>All roles</h1>
<div class="container mt-6">
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success mt-4">
                    {{ session('status') }}
                </div>
            @endif
            <a href="{{route('roles.create')}}" class="btn btn-success mb-4">Add new role</a>
            @foreach($roles as $role)
                <div class="card mb-4">
                    <h5 class="card-header">{{$role->name}}</h5>
                    <div class="card-body">
                        <a href="{{route('roles.edit', $role->id)}}" class="btn btn-primary">Edit</a>
                        <form action="{{route('roles.destroy', $role->id)}}" method="post" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
</body>
</html>

