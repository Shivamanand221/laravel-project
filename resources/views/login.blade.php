<form action="/login" method="post">
    @csrf
    <input type="number" name="id" placeholder="User ID" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
</form>
