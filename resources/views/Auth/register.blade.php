<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h4>Register Page</h4>
    <form action="{{ route('register.store') }}" method="post">
        @method('post')
        @csrf
        @if (Session::has('message'))
            <div>{{ session::get('message') }}</div>
        @endif
        <label for="">username</label><br>
        <input type="username" name="username" style="padding: 4px"><br>
        <span style="color: red">
            @error('username')
                {{ $message }}
            @enderror
        </span><br>
        <label for="">Email</label><br>
        <input type="email" name="email" style="padding: 4px"><br>
        <span style="color: red">
            @error('email')
                {{ $message }}
            @enderror
        </span><br>
        <label for="">Password</label><br>
        <input type="password" name="password" style="padding: 4px"><br>
        <span style="color: red">
            @error('password')
                {{ $message }}
            @enderror
        </span><br>
        <button>Register</button>
        <button><a href="/">LogIn</a></button>

    </form>
</body>

</html>
