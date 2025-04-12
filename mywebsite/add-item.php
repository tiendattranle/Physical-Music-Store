<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include("db_connect.php");
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_POST['image'];
        $category_id = $_POST['category'];
        $description = $_POST['description'];
        $stmt = $conn->prepare("INSERT INTO products (name, description, price, category_id, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiis", $name, $description, $price, $category_id, $image);

        if ($stmt->execute()) {
            echo "<script>alert('Add new item successfully.');
                    window.location.href = '?page=categories';</script>";
        }
    }
?>

<div class="add-item-form">
    <form class="product-description" action = "" method="POST">
        <div class="modify">
            <label id="name">Product name</label>
            <input type="text" name="name" value="" required>
        </div>
        <div class="modify">
            <label id="price">Price</label>
            <input type="number" name="price" value="" min="1000" required>    
        </div>
        <div class="modify">
            <label id="image">Image path</label>
            <input type="text" name="image" placeholder="/images/" value="" required>
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
                        echo "<option value='".$row['id']."'>".$row['name']."</option>";
                    }
                }
                $conn->close();
            ?>
            </select>
        </div>
        <label id="description">Description</label><br>
        <textarea type="text" name="description" rows="10" cols="50" maxlength="2000" required></textarea>
        <button type="submit">Create new item</button>
    </form>
</div>