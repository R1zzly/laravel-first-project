<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<h1>Post</h1>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="post" action="{{route('product.store')}}">
    @csrf
    <div class="input-group mb-3" style="width: 800px; margin: auto; padding-top: 15px">
        <input type="name" name="name" class="form-control" placeholder="Name" aria-label="name" aria-describedby="basic-addon2">
    </div>
    <div class="input-group mb-3" style="width: 800px; margin: auto; padding-top: 15px">
        <input type="price" name="price" class="form-control" placeholder="Price" aria-label="price" aria-describedby="basic-addon2">
    </div>
    <div class="input-group mb-3" style="width: 800px; margin: auto; padding-top: 15px">
        <input type="count" name="count" class="form-control" placeholder="Count" aria-label="count" aria-describedby="basic-addon2">
    </div>
    <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" class="form-control" required>
            <option value="">Select a category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="btn-group position-absolute bottom-50 end-50">
        <button type="submit" class="btn btn-success">Create</button>
    </div>
</form>
</body>
</html>

