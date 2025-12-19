<!DOCTYPE html>
<html>
<head>
    <title>Enter Password</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="bg-white p-6 rounded shadow-md w-96">
        <h2 class="text-xl font-bold mb-4">Protected Site</h2>

        @if($errors->any())
            <p class="text-red-600 mb-3">{{ $errors->first() }}</p>
        @endif

        <form method="POST" action="{{ url('/password/check') }}">
            @csrf
            <input type="password" name="password" placeholder="Enter password"
                class="w-full p-2 border rounded mb-3" required>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">
                Unlock
            </button>
        </form>
    </div>
</body>
</html>
