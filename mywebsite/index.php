<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            <?php 
                $page = isset($_GET['page']) ? $_GET['page'] : 'home';
                $allowed_pages = ['home', 'categories', 'contact', 'log-in', 'sign-up', 'sign-out', 'cart', 'add-item'];
                if (isset($_GET['product-edit'])) {
                    if (isset($_SESSION['role'])) {
                        if ($_SESSION['role'] == 'admin') {
                            echo "Product Editor";
                        }
                        else {
                            echo "404: Page not fount";
                        }
                    }
                    else {
                        echo "404: Page not fount";
                    }
                }
                else if (isset($_GET['product-id'])) {
                    $product_id = $_GET['product-id'];
                    echo "Product $product_id";
                }
                else if (in_array($page, $allowed_pages)) {
                    if ($page == 'home') {
                        echo "143 Record";
                    }
                    else if ($page == 'categories') {
                        $cate = isset($_GET['cate']) ? $_GET['cate'] : '';
                        if ($cate == 'cd') {
                            echo 'CD category';
                        }
                        else if ($cate != '') {
                            echo ucfirst($cate).' category';
                        }
                        else {
                            echo "All categories";
                        }
                    }
                    else if ($page == 'contact') {
                        echo "Contact 143 Record";
                    }
                    else if ($page == 'log-in') {
                        echo "Log in to get access to the store amazing catelog";
                    }
                    else if ($page == 'sign-up') {
                        echo "Sign up now";
                    }
                    else if ($page == 'cart') {
                        echo "Your cart";
                    }
                    else if ($page == 'add-item') {
                        echo "Add new item";
                    }
                } 
                else {
                    echo "404: Page not fount";
                }
            ?>
        </title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/sign-up.css">
        <link rel="stylesheet" href="css/cart.css">
        
    </head>
    <body>
        <script src="js/script.js"></script>
        <header>
            <div class="logo-search">
                <img id="logo" src="images/143 Record Logo.png" alt="143 Record">
                <input class="search" type="text" id="search-box" placeholder="Search..." onkeyup="searchFunction()">
                <div class="container" onclick="myFunction(this)">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
            </div>
            <nav>
                <ul id="nav-bar">
                    <li><a href="?page=home">Home</a></li>
                    <li id="cate"><a href="?page=categories">Categories</a>
                        <ul class="dropdown">
                            <?php
                                include("db_connect.php");
                                $sql = "SELECT * FROM categories";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<li><a href=?page=categories&cate=".strtolower($row["name"]).">".$row["name"]."</a></li>";
                                    }
                                }
                                $conn->close();
                            ?>
                        </ul>
                    </li>
                    <li><a href="?page=contact">Contact</a></li>
                    <?php
                        if (!isset($_SESSION["role"])) {
                            echo '<li><a href="?page=log-in">Log in</a></li>
                                <li><a href="?page=sign-up">Sign up</a></li>';
                        }
                        else if ($_SESSION["role"] == 'user') {
                            echo '<li><a href="?page=sign-out">Log out</a></li>
                                <li><a href="?page=cart">'.$_SESSION['username']."'s cart</a></li>";
                        }
                        else if ($_SESSION["role"] == 'admin') {
                            echo '<li><a href="?page=sign-out">Log out</a></li>';
                        }
                    ?>
                </ul>
            </nav>
        </header>
        <div id="background"></div>

        <main>
            <?php
                $page = isset($_GET['page']) ? $_GET['page'] : 'home';
                $allowed_pages = ['home', 'categories', 'contact', 'log-in', 'sign-up', 'sign-out', 'cart', 'add-item'];
                if (isset($_GET['product-edit'])) {
                    if (isset($_SESSION['role'])) {
                        if ($_SESSION['role'] == 'admin') {
                            $product_id = $_GET['product-edit'];
                            include('product-edit.php');
                        }
                        else {
                            include("404.html");
                        }
                    }
                    else {
                        include("404.html");
                    }
                }
                else if (isset($_GET['product-id'])) {
                    $product_id = $_GET['product-id'];
                    include('product.php');
                }
                else if (in_array($page, $allowed_pages)) {
                    if ($page == 'add-item') {
                        if (isset($_SESSION['role'])) {
                            if ($_SESSION['role'] == 'admin') {
                                include("$page.php");
                            }
                        }
                        else {
                            include("404.html");
                        }
                    }
                    else if ($page == 'cart') {
                        if (isset($_SESSION['role'])) {
                            if ($_SESSION['role'] == 'user') {
                                include("$page.php");
                            }
                        }
                        else {
                            include("404.html");
                        }
                    }
                    else {
                        include("$page.php");
                    }
                } 
                else {
                    include("404.html"); // Show a 404 error page if not allowed
                }
            ?>
        </main>
        <footer>
            <p>&copy; 2025 143 Records. All Rights Reserved.</p>
        </footer>
    </body>
</html>