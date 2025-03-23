<form action="/update/{{ $user->id }}" method="post">
    @csrf
    <input type="text" name="username" value="{{ $user->username }}" required><br>
    <input type="email" name="email" value="{{ $user->email }}" required><br>
    <input type="tel" name="phone" value="{{ $user->phone }}" required><br>
    <button type="submit">Update</button>
</form>
