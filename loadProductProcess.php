<?php

include "connection.php";

$pageno = 0;
$page = $_POST["p"];
//echo($page);

if (0 != $page) {
    $pageno = $page;
} else {
    $pageno = 1;
}

$q = "SELECT * FROM `product`";
$rs = Database::search($q);
$num = $rs->num_rows;
//echo($num);

$results_per_page = 6;
$num_of_pages = $num / $results_per_page;
//echo($num_of_pages);

$page_results = ($pageno - 1) * $results_per_page;
//echo($page_results);

$q2 = $q . " LIMIT $results_per_page OFFSET $page_results";
$rs2 = Database::search($q2);
$num1 = $rs2->num_rows;
$d = $rs2->fetch_assoc();
//echo($num1);

if ($num == 0) {
    echo ("NO AVAILABLE PRODUCTS");
} else {

    for ($x = 0; $x < $num; $x++) {
        $d = $rs->fetch_assoc();
?>
        <tr>
            <th scope="row"><?php echo $d["id"]; ?></th>
            <td><?php echo $d["title"]; ?></td>
            <td><?php echo $d["title"]; ?></td>
            <td><?php if ($d["category_cat_id"] == 1) {
                    echo ("Dress");
                } else if ($d["category_cat_id"] == 2) {
                    echo ("Top");
                } else if ($d["category_cat_id"] == 3) {
                    echo ("Tshirt");
                } else if ($d["category_cat_id"] == 4) {
                    echo ("Jeans");
                } else if ($d["category_cat_id"] == 5) {
                    echo ("Skirts");
                } else if ($d["category_cat_id"] == 6) {
                    echo ("Shoes");
                } else if ($d["category_cat_id"] == 7) {
                    echo ("Bags");
                }

                ?></td>
            <td><?php if ($d["condition_condition_id"] == 1) {
                    echo ("Brand New");
                } else if ($d["condition_condition_id"] == 2) {
                    echo ("Gently Used");
                } else if ($d["condition_condition_id"] == 3) {
                    echo ("Used Once");
                } else if ($d["condition_condition_id"] == 4) {
                    echo ("Preloved");
                } ?></td>
            <td class="mt-2 mb-3"><?php if ($d["status_status_id"] == 1) {
                                        echo ("Available");
                                    } else {
                                        echo ("SoldOut");
                                    }
                                    ?></td>
            <td> <?php

                    if ($d["status_status_id"] == 1) {
                    ?>
                    <button id="bu<?php echo $d['id']; ?>" class="btn btn-outline-danger" onclick="blockProduct('<?php echo $d['id']; ?>');">Sold Out</button>
                    
                <?php
                    } else {
                ?>
                    <button id="bu<?php echo $d['id']; ?>" class="btn btn-danger" onclick="blockProduct('<?php echo $d['id']; ?>');">Available</button>
                <?php

                    }

                ?>
            </td>

        </tr>
    <?php

    }


}

?>