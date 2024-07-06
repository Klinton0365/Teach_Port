<?php
include 'libs/load.php';

$conn = Database::getConnection();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$notification = '';
$error = '';

if (isset($_GET['logout'])) {
    if (Session::isset("session_token")) {
        $Session = new UserSession(Session::get("session_token"));
        if ($Session->removeSession()) {
            error_log("previous Session is removed from db");
            echo "<h3> previous Session is removed from db</h3>";
        } else {
            error_log("Previous Session is not removing from db");
            echo "<h3> Previous Session not removing from db</h3>";
        }
        Session::destroy();
        Session::unset_all();
        echo '<script>window.location.href = "home.php";</script>';
        die();
    }
}

if (!isset($_COOKIE['fingerprint'])) {
    echo '<script>window.location.href = "index.php";</script>';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_POST['action'] == 'signin') {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $pass = $_POST['password'];

            $result = UserSession::authenticate($email, $pass);
            $login = true;

            //$adminLoggedIn = isset($_POST['email']) && $_POST['email'] === 'klinton.developer365@gmail.com';

            if ($login) {
                // if ($adminLoggedIn) {
                //     header("Location: home.php");
                //     exit();
                //} else
                if ($result) {
                    echo '<script>window.location.href = "home.php";</script>';
                } else {
                    $notification = 'Invalid Credentials!';
                }
            }
        }
    } elseif ($_POST['action'] == 'signup') {
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
            $user = $_POST['username'];
            $email = $_POST['email'];
            $pass = $_POST['password'];

            try {
                User::signup($user, $email, $pass);
                $signup = true;
                echo '<script>window.location.href = "home.php";</script>';
                exit();
            } catch (mysqli_sql_exception $e) {
                $error = $e->getMessage();
                $signup = false;
                //echo '<p style="color:red;">Error: ' . $error . '</p>';
                // Custom error message for duplicate entry
                if (strpos($error, "Duplicate entry") !== false && strpos($error, "for key 'user.email'") !== false) {
                    $error = "Email already Exist.";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Teacher Portal Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                <h1>Create Account</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <?php echo '<p style="color:red;">' . $error . '</p>'; ?>
                <!-- <span>or use your email for registration</span> -->
                <input type="text" name="username" placeholder="Name" required />
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Password" required />
                <input type="hidden" name="action" value="signup">
                <button type="submit">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                <h1>Sign in</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <!-- <span>or use your account</span> -->
                <?php echo '<p style="color:red;">' . $notification . '</p>'; ?>
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Password" required />
                <input type="hidden" name="action" value="signin">
                <a href="#">Forgot your password?</a>
                <button type="submit">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/login.js"></script>

</body>

</html>