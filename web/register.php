<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register — GameBoxd</title>
    <link rel="stylesheet" href="styles.css" />

</head>
<body>
    <?php include 'header.php'; ?>  
    <div class="admin-container">
        <h1>GameBoxd</h1>
        <p>Join the community.</p>

        <div class="admin-card">
            <form action="../api/auth.php" method="POST">
                <h3>Create Account</h3>
                
                <input type="hidden" name="action" value="register">
                
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Repeat Password" required>
                
                <button type="submit">Register</button>
            </form>

            <div class="toggle-text">
                Already have an account? <span><a href="login.php">Login here.</a></span>
            </div>
        </div>
    </div>


    <!--Sweet alert 2 widget-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>     
    <script src="../api/login.js"></script>
</body>
</html>