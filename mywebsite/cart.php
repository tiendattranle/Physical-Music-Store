<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_GET['change'])) {
            include("db_connect.php");
            $change = 0;
            $username = $_SESSION['username'];
            $product_id = (isset($_POST['product-id']))? $_POST['product-id'] : -1;
            if ($_GET['change'] == 'place') {
                $sql = "SELECT productid, amount FROM carts WHERE username = '".$_SESSION['username']."';";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $sql = "DELETE FROM carts WHERE username = '".$username."';";
                    $result = $conn->query($sql);
                    echo "<script>alert('Your order is placed successfully.');</script>";
                }
                else {
                    echo "<script>alert('Your cart is empty.');</script>";
                }
            }
            else if ($_GET['change'] == 'remove') {
                $sql = "DELETE FROM carts WHERE username = '".$username."' and productid = ".$product_id.";";
                $result = $conn->query($sql);
            }
            else {
                if ($_GET['change'] == 'minus') {
                    $change = -1;
                }
                else if ($_GET['change'] == 'add') {
                    $change = 1;
                }
                $sql = "SELECT amount FROM carts WHERE username = '".$username."' and productid = ".$product_id.";";
                $result = $conn->query($sql);
                if ($result) {
                    if ($result->num_rows > 0) {
                        $amount = $result->fetch_assoc()['amount'] + $change;
                        if ($amount == 0) {
                            $sql = "DELETE FROM carts WHERE username = '".$username."' and productid = ".$product_id.";";
                        }
                        else {
                            $sql = "UPDATE carts SET amount = ".$amount." WHERE username = '".$username."' and productid = ".$product_id.";";
                        }
                        $result = $conn->query($sql);
                    }
                    else {
                        $sql = "INSERT INTO carts (username, productid, amount) VALUES ('".$username."', $product_id, $amount);";
                        $result = $conn->query($sql);
                    }
                }
            }
            $conn->close();   
        }
    }
?>
<?php
    include("db_connect.php");
    echo "<h1>Shopping cart</h1>";

    $sql = "SELECT productid, amount FROM carts WHERE username = '".$_SESSION['username']."';";
    $result = $conn->query($sql);
    $price = 0;
    echo   "<div class='cart-page'>
                <div class='cart-box'>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sql = "SELECT name, price, image FROM products WHERE id = '".$row['productid']."';";
            $data = $conn->query($sql)->fetch_assoc();
            $price += $data['price'] * $row['amount'];
            echo   "<div class='item'>
                        <a href='?product-id=".$row['productid']."' class='product-box'>
                            <div class='image'>
                                <img src='images/".$data['image']."' alt='".$data["name"]."'>
                                <h5>".$row['amount']."</h5>
                            </div>
                            <h4>".$data["name"]."</h4>
                            <div>
                                ".number_format($data["price"], 0, '', '.')." VND
                            </div>
                        </a>
                        <form action='?page=cart&change=minus' method = 'POST'>
                            <input type='number' name='product-id' value=".$row['productid'].">
                            <button type='submit'>-</button>
                        </form>
                        <form action='?page=cart&change=remove' method = 'POST'>
                            <input type='number' name='product-id' value=".$row['productid'].">
                            <button type='submit'>Remove</button>
                        </form>
                        <form action='?page=cart&change=add' method = 'POST'>
                            <input type='number' name='product-id' value=".$row['productid'].">
                            <button type='submit'>+</button>
                        </form>
                    </div>";
        }
    }
    else {
        echo "There's no items in cart";
    }
    echo       "</div>
                <div class='check-out'>
                    <div class='total-price'>
                        <text>Total</text><text>".number_format($price, 0, '', '.')." VND</text>
                    </div>
                    <div class='line'></div>
                    <form action='?page=cart&change=place' method='POST'>
                        <button type='submit'>Place order</button>
                    </form>
                </div>
           </div>";
    $conn->close();
?>