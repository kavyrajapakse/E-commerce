<?php

include "connection.php";
session_start();

$order_rs = Database::search("SELECT * FROM `order_history` INNER JOIN `order_item` ON
    `order_history`.`ohid`=`order_item`.`order_history_ohid` LIMIT 5");

$num = $order_rs->num_rows;

for ($x = 0; $x < $num; $x++) {
    $d = $order_rs->fetch_assoc();
?>
    <tr>
        <th scope="row"><?php echo $d["order_id"]; ?></th>
        <td><?php echo $d["oi_qty"]; ?></td>
        <td><?php echo $d["users_email"]; ?></td>
        <td>Rs.<?php echo $d["amount"]; ?>.00</td>
    </tr>  
        <?php

    }
