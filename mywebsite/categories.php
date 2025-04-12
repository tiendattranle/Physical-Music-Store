<?php
    include("db_connect.php");

    $url = "?page=categories";

    $limit = 8;
    $numpage = isset($_GET['numpage']) ? $_GET['numpage'] : 1;
    $start = ($numpage - 1) * $limit;

    $cate = isset($_GET['cate']) ? $_GET['cate'] : '';
    $allowed_categories = ['cd', 'vinyl', 'cassette'];
    $cate_sort = '';
    if (in_array($cate, $allowed_categories)) {
        $cate_sort = "WHERE category_id IN (SELECT id FROM categories WHERE name = '$cate')";
        $url = $url . "&cate=$cate";
        if ($cate == 'cd') echo "<h1>Shop all CDs in store</h1>";
        else echo "<h1>Shop all ".$cate."s in store</h1>";
    }
    else {
        echo "<h1>All products in store</h1>";
    }

    $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'id';
    $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';

    $allowed_columns = ['id', 'name', 'price'];
    if (!in_array($sort_by, $allowed_columns)) {
        $sort_by = 'id';
    }
    if (in_array($sort_by, ['name', 'price'])) {
        $url = $url.'&sort_by='.$sort_by;
    }
    if (in_array($order, ['asc', 'desc'])) {
        $url = $url.'&order='.$order;
    }

    $sql = "SELECT * FROM products $cate_sort ORDER BY $sort_by ".strtoupper($order)." LIMIT $start, $limit";
    $data = $conn->query($sql);
    $result = $conn->query("SELECT COUNT(id) AS total FROM products $cate_sort");
    $total = $result->fetch_assoc()['total'];
    $totalPages = ceil($total / $limit);
?>  
<?php 
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            echo "<div class='add-product'>";
        }
    }
?>  
<div class='sort-box'>
    Sort by:
    <a href="<?php echo $url;?>&sort_by=name&order=asc">Name &uarr;</a>
    <a href="<?php echo $url;?>&sort_by=name&order=desc">Name &darr;</a>
    <a href="<?php echo $url;?>&sort_by=price&order=asc">Price &uarr;</a>
    <a href="<?php echo $url;?>&sort_by=price&order=desc">Price &darr;</a>
</div>
<?php 
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            echo "<a href='?page=add-item'>+ Add item</a>
            </div>";
        }
    }
?>  
<?php
    if ($data->num_rows > 0) {
        echo "<div class='product-container'>";
        while ($row = $data->fetch_assoc()) {
            echo "<a href='?product-id=".$row['id']."'><div class='product-box'><img src='images/".$row['image']."' alt='".$row["name"]."'><h4>".$row["name"]."</h4><div>".number_format($row["price"], 0, '', '.')." VND</div></div></a>";
        }
        echo "</div>";
    }
    else {
        echo "0 results";
    }
    $conn->close();
?>
<div class="pagination">
    <?php if ($numpage > 1): ?>
        <a href="<?php echo $url?>&numpage=<?php echo $numpage - 1; ?>">&laquo; Prev</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="<?php echo $url?>&numpage=<?php echo $i; ?>" class="<?php echo ($i == $numpage) ? 'active' : ''; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>

    <?php if ($numpage < $totalPages): ?>
        <a href="<?php echo $url?>&numpage=<?php echo $numpage + 1; ?>">Next &raquo;</a>
    <?php endif; ?>
</div>