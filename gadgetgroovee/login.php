<?php

include 'db_connection.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $contactnumber = $_POST['contactnumber'];
    $password = $_POST['password'];


    $conn = openConnection(); 
    $username = mysqli_real_escape_string($conn, $username);
    $contactnumber = mysqli_real_escape_string($conn, $contactnumber);

 
    $query = $conn->prepare("SELECT * FROM users WHERE username=? AND contactnumber=?");
    $query->bind_param("ss", $username, $contactnumber);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['username'] = $username;
            $_SESSION['usertype'] = $user['user_type']; 
           
            if ($user['user_type'] === 'admin') {
                header('Location: admin_home.php');
            } else {
                header('Location: home2.php');
            }
            exit();
        } else {
            $error = 'Invalid username, phone number, or password';
        }
    } else {
        $error = 'Invalid username, phone number, or password';
    }

    $query->close();
    closeConnection($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" >
    <title>Login now to start shopping</title>
</head>
<body>
    <div class="main">
        <div class="container1">
            <div class="box form-box">
                <header>Welcome Back!</header>
                
                <?php if ($error): ?>
                    <div class="error"><?php echo $error; ?></div>
                <?php endif; ?>

                <form action="" method="post">
                    <div class="field input">
                        <label for="username"></label>
                        <input name="username" id="username" type="text" placeholder="Username" required>
                    </div>
                    <div class="field input">
                        <label for="contactnumber"></label>
                        <input name="contactnumber" id="contactnumber" type="number" placeholder="Phone Number" required>
                    </div>
                    <div class="password-container">
                        <label for="password"></label>
                        <input name="password" id="password" type="password" placeholder="Password" required>
                        <span class="show-password" onclick="togglePassword()"><i class="fa-solid fa-eye"></i></span>
                    </div>
                    <div class="link">
                        <a href="forgot_password.php">Forgot Password?</a>
                    </div>
                    <div class="field">
                        <input name="submit" class="btn" type="submit" value="Login">
                    </div>
                    <div class="links1">
                        Don't have an account? <a href="register.php">Sign up</a>
                    </div>
                </form>

                <script>
                     function togglePassword() {
                        const passwordField = document.getElementById("password");
                        const passwordFieldType = passwordField.getAttribute("type");
                        passwordField.setAttribute("type", passwordFieldType === "password" ? "text" : "password");
                     }
                </script>
            </div>
        </div>
    </div>
</body>
</html>
