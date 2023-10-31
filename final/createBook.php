<html>
    <h1>Add a book!</h1>
    <form action="index.php" method="POST">
    title: <input type="text" name="title" required><br>
    author: <input type="text" name="author" required><br>
    page Number: <input type="number" step="1" min="1" name="pageNum" required><br>
    are you finished?: <input type="radio" name="finished" value="1" required>Yes 
                        <input type="radio" name="finished" value="0">No
                        <br>
        <input type="hidden" name="dbAction" value="createBook">
        <input type="submit" value="add book">
    </form>
</html>