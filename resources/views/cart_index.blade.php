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

<h1>Cart</h1>
@foreach($carts as $el)
    <div class="alert alert-warning">
        <h3>{{ $el->product->name }} </h3>
        <h3>{{ $el->count }} </h3>
        <form action="{{ route('cart.increase', $el->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-sm btn-outline-secondary">+</button>
        </form>
        <form action="{{ route('cart.decrease', $el->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-sm btn-outline-secondary">-</button>
        </form>
    </div>


<form action="{{ route('cart.destroy', $el->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Delete from Cart</button>
</form>
@endforeach

<form action="{{ route('order.place') }}" method="POST">
    @csrf
    @method('POST')
    <button type="submit">Order Products</button>
</form>


</body>
</html>

