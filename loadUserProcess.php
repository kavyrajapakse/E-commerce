<?php

include "connection.php";

$rs = Database::search("SELECT * FROM `users`");

$num = $rs->num_rows;

for ($x = 0; $x < $num; $x++) {
    $d = $rs->fetch_assoc();
?>
    <tr>
        <th scope="row"><?php echo $d["fname"]; ?></th>
        <td><?php echo $d["lname"]; ?></td>
        <td><?php echo $d["email"]; ?></td>
        <td><?php echo $d["mobile"]; ?></td>
        <td><?php echo $d["joined_date"]; ?></td>
        <td class="mt-2 mb-3"><?php if ($d["status"] == 1) {
                                    echo ("Active");
                                } else {
                                    echo ("Inactive");
                                }
                                ?></td>
        <td> <?php

                if ($d["status"] == 1) {
                ?>
                <button id="ub<?php echo $d['email']; ?>" class="btn btn-outline-danger" onclick="blockUser('<?php echo $d['email']; ?>');">Block</button>
                
            <?php
                } else {
            ?>
                <button id="ub<?php echo $d['email']; ?>" class="btn btn-danger" onclick="blockUser('<?php echo $d['email']; ?>');">Unblock</button>
            <?php

                }

            ?>
        </td>

    </tr>
<?php

}




?>