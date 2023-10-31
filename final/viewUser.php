<html>
    <h1>View the users</h1>
    <table border="2">
        <tr>
            <th>Id</th>
            <th>username</th>
            <th>password</th>
        </tr>
        <?php for($i = 0; $i < count($elements)/3; $i++): ?>
        <tr>
            <td><?php echo $elements[3*$i]; ?></td>
            <td><?php echo $elements[(3*$i)+1]; ?></td>
            <td><?php echo $elements[(3*$i)+2]; ?></td>
        </tr>
        <?php endfor ?>
    </table>
</hmtl>