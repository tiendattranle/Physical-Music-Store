<section>
    <?php
        include("db_connect.php");
        if ($_SERVER["REQUEST_METHOD"] == "POST") {    
            if (!isset($_SESSION['role'])) {
                $conn->close();
                header("Location: ?page=log-in");
                exit();
            }
            if ($_SESSION['role'] != 'admin') {
                $amount = $_POST['amount'];
                if ($product_id > 0 && $amount > 0) {
                    $sql = "SELECT amount FROM carts WHERE username = '".$_SESSION['username']."' and productid = ".$product_id.";";
                    $result = $conn->query($sql);
                    if ($result) {
                        if ($result->num_rows > 0) {
                            $sql = "UPDATE carts SET amount = ".($amount + $result->fetch_assoc()['amount'])." WHERE username = '".$_SESSION['username']."' and productid = ".$product_id.";";
                            $result = $conn->query($sql);
                        }
                        else {
                            $sql = "INSERT INTO carts (username, productid, amount) VALUES ('".$_SESSION['username']."', $product_id, $amount);";
                            $result = $conn->query($sql);
                        }
                        $message = 'Successfully add items to cart!';
                    }
                    else {
                        $message = 'Error add items to cart.';
                    }
                    echo "<script>alert('$message');</script>";
                }
            }
            else {
                echo "<script>alert('Admin cannot add item to cart!');</script>";
            }
        }
        $conn->close();
    ?>
    <?php
    include("db_connect.php");
    
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $data = $conn->query($sql)->fetch_assoc();
    echo   "<div class='product-page'>
                <div class='image'>
                    <img src='images/".$data['image']."' alt='".$data["name"]."'>
                </div>
                <div class='product-description'>";
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            echo   "<a href='?product-edit=$product_id'>Edit</a>";
        }
    }
    echo           "<h1>".$data["name"]."</h1>
                    <h3>
                        ".number_format($data["price"], 0, '', '.')." VND
                    </h3>
                    <form action='' method = 'POST'>
                        <label for='num'>Quantity:</label>
                        <input type='number' id='num' name='amount' value='1' min='1' required>
                        <button type='submit'>Add to Cart</button>
                    </form>
                    <text>".nl2br($data['description'])."</text>
                </div>
            </div>";
    ?>
</section>