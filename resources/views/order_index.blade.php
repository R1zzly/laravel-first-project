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

<h1>Orders</h1>
@foreach($orders as $el)
    <div class="alert alert-warning">
        @foreach($el->products as $product)
            <h3><h3>{{$product->name}}</h3></h3>
        @endforeach
        <h3>{{$el->total_price}}</h3>
        <h3>{{$el->status}}</h3>
    </div>

@endforeach

</body>
</html>

