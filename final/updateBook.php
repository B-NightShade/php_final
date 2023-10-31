<html>
    <h1>Update a book!</h1>
    <form action="index.php" method="POST">
    title: <input type="text" name="title" value="<?php echo $elements[1]; ?>"required><br>
    author: <input type="text" name="author" value="<?php echo $elements[2]; ?>" required><br>
    page Number: <input type="number" step="1" min="1" name="pageNum" value="<?php echo $elements[3]; ?>" required><br>
    <?php if($elements[4] == '1'): ?>
    are you finished?: <input type="radio" name="finished" value="1" required checked>Yes 
                        <input type="radio" name="finished" value="0">No
                        <br>
    <?php endif ?>
    <?php if($elements[4] == '0'): ?>
    are you finished?: <input type="radio" name="finished" value="1" required>Yes 
                        <input type="radio" name="finished" value="0" checked>No
                        <br>
    <?php endif ?>
        <input type="hidden" name="dbAction" value="updateBook">
        <input type="hidden" name="bookid" value="<?php echo $elements[0]; ?>">
        <input type="hidden" name="userid" value="<?php echo $elements[5]; ?>">
        <input type="submit" value="update book">
    </form>
</html>