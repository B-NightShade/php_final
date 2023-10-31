<html>
    <h1>Your Books<h1>
    <table border="2">
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Author</th>
            <th>page Number</th>
            <th>finished</th>
            <th>userID</th>
            <th></th>
            <th></th>
        </tr>
        <?php for($i = 0; $i < count($elements)/6; $i++): ?>
        <tr>
            <td><?php echo $elements[6*$i]; ?></td>
            <td><?php echo $elements[(6*$i)+1]; ?></td>
            <td><?php echo $elements[(6*$i)+2]; ?></td>
            <td><?php echo $elements[(6*$i)+3]; ?></td>
            <td><?php echo $elements[(6*$i)+4]; ?></td>
            <td><?php echo $elements[(6*$i)+5]; ?></td>
            <td><a href="index.php?action=updateBook&bookid=<?php echo $elements[6*$i];?>&userid=<?php echo $elements[(6*$i)+5]; ?>">Update</a>
            <td><a href="index.php?action=deleteBook&bookid=<?php echo $elements[6*$i];?>&userid=<?php echo $elements[(6*$i)+5]; ?>">Delete</a>
        </tr>
        <?php endfor ?>
    </table>
</html>