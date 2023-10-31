<html>
    <h1>Create a user!</h1>
    <p>usernames must be unique!</p>

    <form action="index.php" method="POST">
        username: <input type="text" name="username" required><br>
        password: <input type="password" name="password" required><br>
        <input type="hidden" name="dbAction" value="createUser">
        <input type="submit" value="add User">
    </form>
</html>