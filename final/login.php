<hmtl>
<h1>Login</h1>
    <h4><?php echo $error ?> </h4>
    <form action="index.php" method="POST">
        username: <input type="text" name="username" required><br>
        password: <input type="password" name="password" required><br>
        <input type="hidden" name="dbAction" value="login">
        <input type="submit" value="login">
    </form>
</hmtl>