<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-2xl">
            <h2 class="text-2xl font-bold text-center mb-4">Register</h2>
            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-400 rounded">
                    {{ session('error') }}
                </div>
            @endif
                @if (count($errors)>0)
                <div class="p-4 bg-red-100 border rounded border-red-700">
                    @foreach ( $errors->all() as $error )
                        <div class="text-red-500">
                            {{$error}}
                        </div>
                    @endforeach
                </div>
                @endif
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-4 flex gap-4">
                    <div class=" flex w-1/2 flex-col">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="flex w-1/2 flex-col">
                        <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                        <input type="text" name="username" id="username" value="{{ old('username') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                </div>

                <div class="mb-4 flex gap-4">
                    <div class="flex w-1/2 flex-col">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="flex w-1/2 flex-col">
                        <label for="phone_number" class="block text-gray-700 text-sm font-bold mb-2">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                </div>

                
                <div class="mb-4">
                    <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address</label>
                    <input type="text" name="address" id="address" value="{{ old('address') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4 flex gap-4">
                    <div class="flex w-1/2 flex-col">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                        <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="flex w-1/2 flex-col">
                        <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                    <select name="role" id="role" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <option value="anggota">Anggota</option>
                        <option value="bendahara">Bendahara</option>
                        <option value="ketua">Ketua</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Register</button>
                </div>
            </form>
            <p class="text-center text-sm text-gray-600 mt-4">
                Already have an account? <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">Login</a>
            </p>
        </div>
    </div>
</body>
</html>
</body>
</html>
