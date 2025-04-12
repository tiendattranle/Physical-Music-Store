<?php
    $product_id = isset($_GET['product-id'])? $_GET['product-id']: -1;
    $username = $_SESSION['username'];
    if (isset($_GET['change'])) {
        include("db_connect.php");
        $change = -2;
        if ($_GET['change'] == 'minus') {
            $change = -1;
        }
        else if ($_GET['change'] == 'add') {
            $change = 1;
        }
        else if ($_GET['change'] == 'remove') {
            $sql = "DELETE FROM carts WHERE username = '".$username."' and productid = ".$product_id.";";
            $result = $conn->query($sql);
            $conn->close();
            // header("Location: ?page=cart");
            exit();
        }
        $sql = "SELECT amount FROM carts WHERE username = '".$username."' and productid = ".$product_id.";";
        $result = $conn->query($sql);
        if ($result) {
            if ($result->num_rows > 0) {
                $sql = "UPDATE carts SET amount = ".($result->fetch_assoc()['amount']) + $change." WHERE username = '".$_SESSION['username']."' and productid = ".$product_id.";";
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
        $conn->close();
    }
    header("Location: ?page=cart");
?>