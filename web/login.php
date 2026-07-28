<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login — GameBoxd</title>
    <link rel="stylesheet" href="styles.css" />

</head>


<body>
    <?php include 'header.php'; ?>  

    <div class="admin-container">
        <h1>GameBoxd</h1>
        <p>Log in to track your games.</p>

        <div class="admin-card">
            <form action="../api/auth.php" method="POST">
                
                <h3 id="formTitle">LOG IN</h3>

                <input type="hidden" name="action" value="login">


                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                
                <button class="button" type="submit">Log in</button>
            </form>

            <div class="toggle-text" id="toggleAuth">
                Don't have an account? <span><a href="register.php">Register here.</a></span>
            </div>
        </div>
    </div>
    
    <!--Sweet alert 2 widget-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>     
    <script src="../api/login.js"></script>
</body>
</html>