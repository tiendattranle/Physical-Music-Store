<section>
    <?php
    include("db_connect.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_POST["password"] != $_POST["cfmpassword"]) {
            header("Location: ?page=sign-up&status=failpass");
            $conn->close();
            exit();
        }
        $username = trim($_POST["username"]);
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $cfmpassword = password_hash($_POST["cfmpassword"], PASSWORD_DEFAULT);
        $role = "user";

        
        $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $role);

        if ($stmt->execute()) {
            header("Location: ?page=sign-up&status=success");
        } else {
            header("Location: ?page=sign-up&status=failname");
        }

        $stmt->close();
    }
    $conn->close();
    ?>
    <div id="signupbox">
        <h1>Sign up</h1>
        <form action = "" method="POST">
            <input type="username" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="cfmpassword" placeholder="Confirm Password" required>
            <br><text>Already had an account? <a href="?page=log-in">Log in</a></text><br>
            <?php
                $status = isset($_GET['status']) ? $_GET['status'] : '';
                if ($status == 'failpass') {
                    echo "<text style='color: red;'>Password and confirm password are not the same.</text><br>";
                }
                else if ($status == 'failname') {
                    echo "<text style='color: red;'>This username is already registed.</text><br>";
                }
                else if ($status == 'success') {
                    echo "<text style='color: green;'>Your account is successfully registed.</text><br>";
                }  
            ?>
            <button type="submit">Sign Up</button>
        </form>
    </div>
</section>