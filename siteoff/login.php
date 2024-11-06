<?php
session_start();
require_once "database.php";

$error = [];
$success = "";


if (isset($_POST["register"])) {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repeat_password = $_POST["repeat_password"];

    
    if (empty($fullname) || empty($email) || empty($password) || empty($repeat_password)) {
        $error[] = "Please fill in all fields";
    }
    if ($password !== $repeat_password) {
        $error[] = "Passwords do not match";
    }

    
    if (count($error) === 0) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $fullname, $email, $hashed_password);
            if (mysqli_stmt_execute($stmt)) {
                $success = "Registration successful! You can now log in.";
            } else {
                $error[] = "Error during registration";
            }
        } else {
            $error[] = "SQL error";
        }
    }
}


if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE fullname = ?";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $username;
                header("Location: home.php");
                exit();
            } else {
                $error[] = "Incorrect password";
            }
        } else {
            $error[] = "No user found with this username";
        }
    } else {
        $error[] = "SQL error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login or Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
          integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="stylelogin.css">
</head>
<body style="display:flex; align-items:center; justify-content:center;">
<div class="login-page">
    <div class="form">

       
        <?php if (!empty($error)): ?>
            <div class="error-messages">
                <?php foreach ($error as $err): ?>
                    <p style="color:red;"><?php echo $err; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success-message">
                <p style="color:green;"><?php echo $success; ?></p>
            </div>
        <?php endif; ?>

        <form class="register-form" method="POST" action="">
            <h2>Register</h2>
            <input value="<?php if(isset($fullname)) echo htmlspecialchars($fullname); ?>" type="text" name="fullname" placeholder="Username *" required />
            <input value="<?php if(isset($email)) echo htmlspecialchars($email); ?>" type="email" name="email" placeholder="Email *" required />
            <input type="password" name="password" placeholder="Password *" required />
            <input type="password" name="repeat_password" placeholder="Repeat Password *" required />
            <button type="submit" name="register">Create</button>
            <p class="message">Already registered? <a href="#" class="toggle-form">Sign In</a></p>
        </form>

        <form class="login-form" method="POST" action="">
            <h2>Login</h2>
            <input value="<?php if(isset($username)) echo htmlspecialchars($username); ?>" type="text" name="username" placeholder="Username" required />
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit" name="login">Login</button>
            <p class="message">Not registered? <a href="#" class="toggle-form">Create an account</a></p>
        </form>

    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="index.js"></script>
</body>
</html>
