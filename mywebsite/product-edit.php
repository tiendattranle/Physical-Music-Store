<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($product_id > 0) {
            include("db_connect.php");
            
            $name = $_POST['name'];
            $price = $_POST['price'];
            $image = $_POST['image'];
            $category_id = $_POST['category'];
            $description = $_POST['description'];
            $stmt = $conn->prepare("UPDATE products 
                                            SET name = ?, 
                                                description = ?, 
                                                price = ?,
                                                category_id = ?, 
                                                image = ?
                                            WHERE id = ?;");
            $stmt->bind_param("ssiisi", $name, $description, $price, $category_id, $image, $product_id);
            if ($stmt->execute()) {
                echo "<script>alert('Edit item successfully.');
                        window.location.href = '?product-id=$product_id';</script>";
            }
            $conn->close();
        }
    }
    else if ($product_id < 0) {
        include("db_connect.php");
        $product_id = -$product_id;
        $sql = "DELETE FROM products WHERE id = $product_id;";
        $result = $conn->query($sql);
        $conn->close();
        echo "<script>alert('Delete item successfully.');
                    window.location.href = '?page=categories';</script>";
    }
    include("db_connect.php");
        
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $data = $conn->query($sql)->fetch_assoc();
    echo   "<div class='product-page'>
                <div class='image'>
                    <img src='images/".$data['image']."' alt='".$data["name"]."'>
                </div>
                <div class='product-description'>
                    <a href='?product-edit=-$product_id'>Remove item</a>";
    $conn->close();
?>

<form action = "" method="POST">
    <div class="modify">
        <label id="name">Product name</label>
        <input type="text" name="name" value="<?php echo $data['name']; ?>" required>
    </div>
    <div class="modify">
        <label id="price">Price</label>
        <input type="number" name="price" value="<?php echo $data['price']; ?>" min="1000" required>    
    </div>
    <div class="modify">
        <label id="image">Image path</label>
        <input type="text" name="image" value="<?php echo $data['image']; ?>" required>
    </div>
    <div class="modify">
        <label for='options'>Category</label>
        <select id='options' name='category'>
        <?php 
            include("db_connect.php");
            $sql = "SELECT * FROM categories";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='".$row['id']."'";
                    if ($row['id'] == $data['category_id']) {
                        echo " selected";
                    }
                    echo ">".$row['name']."</option>";
                }
            }
            $conn->close();
        ?>
        </select>
    </div>
    <label id="description">Description</label><br>
    <textarea type="text" name="description" rows="10" cols="50" maxlength="2000" required><?php echo $data['description']; ?></textarea>
    <div class="form-button">
        <button href="?product-id=<?php echo $product_id?>">Discard changes</button>
        <button type="submit">Submit changes</button>
    </div>
</form>
</div>
</div>