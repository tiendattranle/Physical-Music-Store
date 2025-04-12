<section>
    <?php
    include("db_connect.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);

        $stmt = $conn->prepare("SELECT password, role FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($hashed_password, $role);

        if ($stmt->num_rows > 0) {
            $stmt->fetch();
            if (password_verify($password, $hashed_password)) {
                session_start();
                $_SESSION["username"] = $username;
                $_SESSION["role"] = $role;

                if ($role === "admin") {
                    header("Location: ?page=home");
                } else {
                    header("Location: ?page=home");
                }
            } else {
                header("Location: ?page=log-in&status=fail");
            }
        } else {
            header("Location: ?page=log-in&status=fail");
        }
        $stmt->close();
    }
    $conn->close();
    ?>
    <div id="signupbox">
        <h1>Log in</h1>
        <form action = "" method="POST">
            <input type="username" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <br><text>Do not have an account? <a href="?page=sign-up">Sign up</a></text><br>
            <?php
                $status = isset($_GET['status']) ? $_GET['status'] : '';
                if ($status == 'fail') {
                    echo "<text style='color: red;'>Invalid username or password.</text><br>";
                }
            ?>
            <button type="submit">Log in</button>
        </form>
    </div>
</section>
