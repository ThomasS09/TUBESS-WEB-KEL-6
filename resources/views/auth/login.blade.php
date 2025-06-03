<!DOCTYPE html>
@php
    use Illuminate\Support\Facades\Route;
@endphp

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Autowash</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .left-bg {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }
        .login-button {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }
        .login-button:hover {
            background: linear-gradient(135deg, #5a67d8, #6b46c1);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="w-full max-w-6xl bg-white rounded-2xl overflow-hidden shadow-2xl grid grid-cols-1 md:grid-cols-2">
        <!-- Left side -->
        <div class="left-bg text-white flex flex-col justify-center p-10">
            <h2 class="text-3xl font-bold mb-4">Nice to see you again</h2>
            <p class="mb-6">Welcome back to Autowash. Please log in to continue using our services and manage your car wash appointments.</p>
            <img src="https://img.freepik.com/free-vector/secure-login-concept-illustration_114360-4946.jpg?w=826&t=st=1689751549~exp=1689752149~hmac=fa8d7b45328b105bd0b2a8c08b0a93ae45e2e0e44f9b0b0cd8efb4e73b015bc6" alt="Welcome" class="w-full max-w-xs mt-4 mx-auto">
        </div>

        <!-- Right side / Login form -->
        <div class="p-10 flex flex-col justify-center">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Login to Autowash</h2>

            @if (session('status'))
                <div class="mb-4 text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4">
                    <ul class="text-sm text-red-600 list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Remember me -->
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="mr-2 h-4 w-4 text-indigo-600">
                    <label for="remember" class="text-sm text-gray-600">Remember me</label>
                </div>

                <!-- Login Button -->
                <div>
                    <button type="submit"
                        class="login-button w-full text-white py-2 rounded-md font-semibold shadow-md hover:shadow-lg transition">
                        Log In
                    </button>
                </div>

                <!-- Forgot Password -->
                @if (Route::has('password.request'))
                    <div class="text-center mt-4">
                        <a class="text-sm text-indigo-600 hover:underline" href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>

</body>
</html>
