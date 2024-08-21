<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Messages</title>
</head>
<body>
<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('message') }}" method="POST">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="message">New Message:</label>
            <textarea class="form-control" id="message" name="text" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Message</button>
    </form>

    <hr>

    @foreach($messages as $message)
        <div class="row {{ auth()->id() === $message->user_id ? 'justify-content-end' : '' }}">
            <div class="col-md-6">
                <small class="text-muted">
                    <strong>{{ $message->user->name }} | </strong>
                </small>
                <small class="text-muted float-right">
                    {{ $message->time }}
                </small>
                <div class="alert alert-{{ auth()->id() === $message->user_id ? 'primary' : 'secondary' }}" role="alert">
                    {{ $message->text }}
                </div>
            </div>
        </div>
    @endforeach
</div>
</body>
</html>
