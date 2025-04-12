<div id="results"></div>
<?php
    include("db_connect.php");

    $url = "?page=home";

    $limit = 4;
    $start = 0;

    $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'id';
    $order = isset($_GET['order']) ? $_GET['order'] : 'DESC';

    $allowed_columns = ['id', 'name', 'price'];
    if (!in_array($sort_by, $allowed_columns)) {
        $sort_by = 'id';
    }

    $cate = isset($_GET['cate']) ? $_GET['cate'] : '';
    $allowed_categories = ['cd', 'vinyl', 'cassette'];
    $cate_sort = '';
    if (in_array($cate, $allowed_categories)) {
        $cate_sort = "WHERE category_id IN (SELECT id FROM categories WHERE name = '$cate')";
        $url = $url."&cate=$cate";
        if ($cate == 'cd') echo "<h1>Shop all CDs in store</h1>";
        else echo "<h1>Shop all ".$cate."s in store</h1>";
    }
    else {
        echo "<h1>Latest products in store</h1>";
    }
    
    echo "<div class='intro-box'>";
    $sql = "SELECT * FROM products $cate_sort ORDER BY $sort_by $order LIMIT $start, $limit";
    $data = $conn->query($sql);
    $result = $conn->query("SELECT COUNT(id) AS total FROM products $cate_sort");
    $total = $result->fetch_assoc()['total'];
    $totalPages = ceil($total / $limit);

    echo "<div class='intro-container'>";
    if ($data->num_rows > 0) {
        while ($row = $data->fetch_assoc()) {
            echo "<a href='?product-id=".$row['id']."'><div class='product-box'><img src='images/".$row['image']."' alt='".$row["name"]."'><h4>".$row["name"]."</h4><div>".number_format($row["price"], 0, '', '.')." VND</div></div></a>";
        }
    }
    else {
        echo "0 results";
    }
    echo "</div><a href=?page=categories".">&rarr; Go to all products</a></div>";
    $conn->close();
?>