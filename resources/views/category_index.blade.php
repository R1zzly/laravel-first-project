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

<h1>All categoryes</h1>
@foreach($categories as $el)
    <div class="alert alert-warning">
        <h3>{{ $el->category }} </h3>
        <a href="{{route('category.edit',$el->id)}}">edit</a>
        <a href="{{route('category.products',$el->id)}}">prod</a>
    </div>


<form action="{{ route('category.destroy', $el->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Delete Category</button>
</form>

@endforeach


<div class="btn-group" style="margin: auto; width: 60%; padding: 10px; padding-left: 350px">
    <a href="{{route('category.create')}}" class="btn btn-success">Send</a>
</div>

</body>
</html>

