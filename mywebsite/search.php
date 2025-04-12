<?php
    include("db_connect.php");
    if (isset($_GET['q'])) {
        $query = $conn->real_escape_string($_GET['q']);

        $sql = "SELECT * FROM products WHERE name LIKE '%$query%' LIMIT 8";
        $result = $conn->query($sql);

        echo "<h1>Search results for: $query</h1>";
        if ($result->num_rows > 0) {
            echo "<div class='product-container'>";
            while ($row = $result->fetch_assoc()) {
                echo "<a href='?product-id=".$row['id']."'><div class='product-box'><img src='images/".$row['image']."' alt='".$row["name"]."'><h4>".$row["name"]."</h4><div>".number_format($row["price"], 0, '', '.')." VND</div></div></a>";
            }
            echo "</div>";
        } else {
            echo "<div id='no-results'>No results found</div>";
        }
    }

    $conn->close();
?>
