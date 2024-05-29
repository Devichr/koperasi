<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="container mx-auto">
        <h1>Register</h1>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div>
                <label for="name">name</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div>
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>
            <div>
                <label for="role">Role</label>
                <select name="role" id="role" required>
                    <option value="anggota">Anggota</option>
                    <option value="bendahara">Bendahara</option>
                    <option value="ketua">Ketua</option>
                </select>
            </div>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
