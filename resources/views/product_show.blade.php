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

    <h1>Product</h1>
    <div class="alert alert-warning">
        <h3>Name: {{ $products->name }}</h3>
        <h3>Price:{{ number_format($products->price, 2) }}</h3>
        <h3>{{ $products->count }} counts</h3>
        <h3>Category: {{ $products->category->category }}</h3>
    </div>


    <h1>Review: </h1>
    <form action="{{ route('reviews.store', $products->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="rating">Rating:</label>
            <select id="rating" name="rating" class="form-control" required>
                <option value="">Select Rating</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="form-group">
            <label for="review">Review:</label>
            <textarea id="review" name="review" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Review</button>
    </form>

    <h3>Reviews</h3>
    @foreach ($products->reviews as $review)
        <div class="review">
            <p><strong>{{ $review->user->name }}</strong> - {{ $review->rating }}/5</p>
            <p>{{ $review->review }}</p>
        </div>
    @endforeach
</body>
</html>

